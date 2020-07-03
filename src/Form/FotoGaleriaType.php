<?php

namespace App\Form;

use App\Entity\FotoGaleria;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FotoGaleriaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('nombre_foto')
            ->add('idGaleria', HiddenType::class)
            ->add('foto', FileType::class, ['label' => 'Foto', 'mapped' => false, 'multiple'=>true ] )
            //->add('url_foto')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FotoGaleria::class,
        ]);
    }
}
