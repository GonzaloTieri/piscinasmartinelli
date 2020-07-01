<?php

namespace App\Controller;

use App\Entity\FotoGaleria;
use App\Form\FotoGaleriaType;
use App\Repository\FotoGaleriaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DomCrawler\Image;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\VarDumper\Exception\ThrowingCasterException;

/**
 * @Route("/foto/galeria")
 */
class FotoGaleriaController extends AbstractController
{
    /**
     * @Route("/", name="foto_galeria_index", methods={"GET"})
     */
    public function index(FotoGaleriaRepository $fotoGaleriaRepository): Response
    {
        return $this->render('foto_galeria/index.html.twig', [
            'foto_galerias' => $fotoGaleriaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}/new", name="foto_galeria_new", methods={"GET","POST"})
     */
    public function new(Request $request, int $id, SluggerInterface $slugger): Response
    {
        $fotoGalerium = new FotoGaleria();
        $fotoGalerium->setIdGaleria($id);
        $form = $this->createForm(FotoGaleriaType::class, $fotoGalerium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $foto = $form->get('foto')->getData();

            $originalFilename = pathinfo($foto->getClientOriginalName(), PATHINFO_FILENAME);
            
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = 'GONZALO'.$safeFilename.'-'.uniqid().'.'.$foto->guessExtension();
            
            try {
                $foto->move(
                    $this->getParameter('foto_galeria_path')."/{$id}" ,
                    $newFilename
                );
            } catch (FileException $e) {
                throw $e;
                // ... handle exception if something happens during file upload
            }

            $fotoGalerium->setNombreFoto($newFilename);
            $fotoGalerium->setUrlFoto($newFilename);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($fotoGalerium);
            $entityManager->flush();

            return $this->redirectToRoute('admin_galeria', array('id'=>$id));
        }

        return $this->render('foto_galeria/new.html.twig', [
            'foto_galerium' => $fotoGalerium,
            'form' => $form->createView(),
        ]);
    }

    /*
     * @Route("/{id}", name="foto_galeria_show", methods={"GET"})
     
    public function show(FotoGaleria $fotoGalerium): Response
    {
        return $this->render('foto_galeria/show.html.twig', [
            'foto_galerium' => $fotoGalerium,
        ]);
    }
*/
    /*
     * @Route("/{id}/edit", name="foto_galeria_edit", methods={"GET","POST"})
     
    public function edit(Request $request, FotoGaleria $fotoGalerium): Response
    {
        $form = $this->createForm(FotoGaleriaType::class, $fotoGalerium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('foto_galeria_index');
        }

        return $this->render('foto_galeria/edit.html.twig', [
            'foto_galerium' => $fotoGalerium,
            'form' => $form->createView(),
        ]);
    }
*/
    /**
     * @Route("/{id}", name="foto_galeria_delete", methods={"DELETE"})
     */
    public function delete(Request $request, FotoGaleria $fotoGalerium): Response
    {
        if ($this->isCsrfTokenValid('delete'.$fotoGalerium->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($fotoGalerium);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_galeria', array('id'=> $fotoGalerium->getIdGaleria() ));
    }
}
