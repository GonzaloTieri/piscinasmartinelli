<?php

namespace App\Controller;

use App\Entity\ConsultaMail;
use App\Entity\FotoGaleria;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Galery;
use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\PathPackage;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;
use Symfony\Component\Asset\VersionStrategy\StaticVersionStrategy;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(Request $request)
    { 
/*
        $this->createFormBuilder($consultaEmail)
        ->add('nombre', TextType::class)
        ->add('email', TextType::class)
        ->add('telefono', TextType::class)
        ->add('mensaje', TextType::class)
        ->add('enviar', SubmitType::class, ['label'=> 'Enviar'])
        ->getForm();
  */      
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

    /**
     * @Route("/sendemail", methods={"POST"}))
     */
    public function sendEmail(Request $request, MailerInterface $mailer) {

        if($request->isXmlHttpRequest()){
            $consultaEmail = new ConsultaMail();
            $consultaEmail->setNombre($request->request->get('name'));
            $consultaEmail->setEmail($request->request->get('email'));
            $consultaEmail->setTelefono($request->request->get('phone'));
            $consultaEmail->setMensaje($request->request->get('message'));

            // Mail 
            $email = (new Email())
            ->from('contacto@piscinasmartinelli.com.ar')
            ->to('contacto@piscinasmartinelli.com.ar')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            ->replyTo($consultaEmail->getEmail())
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Consulta desde sitio WEB')
            ->text($consultaEmail->getMensaje());
            //->html('<p>See Twig integration for better HTML integration!</p>');

        $mailer->send($email);

        }

        return $this->json(['data' => 200]);

    }

}
