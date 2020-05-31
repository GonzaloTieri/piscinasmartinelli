<?php

namespace App\Controller;

use App\Entity\FotoGaleria;
use App\Entity\Galery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
        $galeryRepo = $this->getDoctrine()->getRepository(Galery::class);
        $galeries = $galeryRepo->findAll();
        
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'galeries'=>$galeries
        ]);
    }

    /**
     * @Route("/admin/galeria/{id}", name="admin_galeria")
     */
    public function galeria($id) {
        $galeryRepo = $this->getDoctrine()->getRepository(Galery::class);
        $galery = $galeryRepo->find($id);
        $fotosRepo = $this->getDoctrine()->getRepository(FotoGaleria::class);
        $fotosGaleria = $fotosRepo->findByIdGaleria($id);
        //var_dump($galery);
        //die();  
        return $this->render('admin/galeriaItem.html.twig', [
            'controller_name' => 'AdminController',
            'galery' => $galery,
            'photos' => $fotosGaleria
        ]);
    }
}
