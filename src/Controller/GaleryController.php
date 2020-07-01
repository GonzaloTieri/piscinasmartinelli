<?php

namespace App\Controller;

use App\Entity\Galery;
use App\Form\GaleryType;
use App\Repository\GaleryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * @Route("/galery")
 */
class GaleryController extends AbstractController
{
    /**
     * @Route("/", name="galery_index", methods={"GET"})
     */
    public function index(GaleryRepository $galeryRepository): Response
    {
        return $this->render('galery/index.html.twig', [
            'galeries' => $galeryRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="galery_new", methods={"GET","POST"})
     */
    public function new(Request $request, SluggerInterface $slugger): Response
    {
        $galery = new Galery();
        $form = $this->createForm(GaleryType::class, $galery, [
            'require_foto' => true,
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** Foto de la Galeria */
            $foto = $form->get('foto')->getData();

            $originalFilename = pathinfo($foto->getClientOriginalName(), PATHINFO_FILENAME);
            
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename =  $safeFilename.'-'.uniqid().'.'.$foto->guessExtension();
            
            try {
                $foto->move(
                    $this->getParameter('foto_galeria_path')."/portadasGalerias" ,
                    $newFilename
                );
            } catch (FileException $e) {
                throw $e;
                // ... handle exception if something happens during file upload
            }
            
            $galery->setUrlFotoPortada($newFilename);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($galery);
            $entityManager->flush();

            return $this->redirectToRoute('admin');
        }

        return $this->render('galery/new.html.twig', [
            'galery' => $galery,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="galery_show", methods={"GET"})
     */
    public function show(Galery $galery): Response
    {
        return $this->render('galery/show.html.twig', [
            'galery' => $galery,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="galery_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Galery $galery, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(GaleryType::class, $galery, [
            'require_foto' => false,
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $foto = $form->get('foto')->getData();

            if($foto){
                $originalFilename = pathinfo($foto->getClientOriginalName(), PATHINFO_FILENAME);
            
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename =  $safeFilename.'-'.uniqid().'.'.$foto->guessExtension();
                
                try {
                    $foto->move(
                        $this->getParameter('foto_galeria_path')."/portadasGalerias" ,
                        $newFilename
                    );
                } catch (FileException $e) {
                    throw $e;
                    // ... handle exception if something happens during file upload
                }
                
                $galery->setUrlFotoPortada($newFilename);
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_galeria', array('id'=>$galery->getId() ));
        } 

        return $this->render('galery/edit.html.twig', [
            'galery' => $galery,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="galery_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Galery $galery): Response
    {
        if ($this->isCsrfTokenValid('delete'.$galery->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($galery);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin');
    }
}
