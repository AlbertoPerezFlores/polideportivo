<?php

namespace App\Form;

use App\Entity\Noticias;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\File;

class NoticiasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titulo')
            ->add('descrip')
            ->add('descripExtend')
            ->add('organizador')
            ->add('imagen',FileType::class,[
                'data_class' => null,
                'label' => 'Imagen'
            ])
            ->add('fechapublicacion',DateType::class,[
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Noticias::class,
        ]);
    }
}
