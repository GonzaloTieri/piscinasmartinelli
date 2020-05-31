<?php

namespace App\Controller;

use App\Entity\FotoGaleria;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Galery;
use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\PathPackage;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;
use Symfony\Component\Asset\VersionStrategy\StaticVersionStrategy;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
            'ROOT_PATH' =>  "/"
        ]);
    }

    /**
     * @Route("/galeria", name="galeria")
     */
    public function galeria()
    {
        $galeryRepo = $this->getDoctrine()->getRepository(Galery::class);
        $galeries = $galeryRepo->findAll();
        return $this->render('index/galeria.html.twig', [
            'controller_name' => 'IndexController',
            'galeries'=>$galeries
        ]);
    }

    /**
     * @Route("/galeria/{id}", name="galeriaItem")
     */
    public function galeriaItem($id)
    {
        /**
         * b*e
         * *p/*
         * *****if
         * ine
         * 1984
         */
        $galeryRepo = $this->getDoctrine()->getRepository(Galery::class);
        $galery = $galeryRepo->find($id);
        $fotosRepo = $this->getDoctrine()->getRepository(FotoGaleria::class);
        $fotosGaleria = $fotosRepo->findByIdGaleria($id);
        //var_dump($galery);
        //die();  
        return $this->render('index/galeriaItem.html.twig', [
            'controller_name' => 'IndexController',
            'galery' => $galery,
            'photos' => $fotosGaleria
            
        ]);
    }

}
