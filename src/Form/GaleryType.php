<?php

namespace App\Form;

use App\Entity\Galery;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GaleryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre_galeria', TextType ::class, ['label'=>'Nombre Album'])
            ->add('foto', FileType::class, ['label' => 'Foto Portada', 'mapped' => false, 'required' => $options['require_foto'] ] )
            //->add('url_foto_portada')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Galery::class,
            'require_foto' => true,
        ]);
        $resolver->setAllowedTypes('require_foto', 'bool');
    }
}
