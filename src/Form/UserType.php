<?php

namespace App\Form;

use App\Entity\PerfilUsuario;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;



class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', TextType::class, [
                'label' => 'Correo',
                'required' => false,
                'attr' => [
                    'class' => 'form-control'
                ],
                'label_attr' => [
                    'style' => 'font-weight: bold; margin-top: 2em;'
                ]
            ])
            ->add('perfil_nombre', TextType::class, [
                'label' => 'Nombre del perfil',
                'required' => false,
                'property_path' => 'perfil.nombre',
                'attr' => [
                    'class' => 'form-control'
                ],
                'label_attr' => [
                    'style' => 'font-weight: bold; margin-top: 2em;'
                ]
            ])
            ->add('perfil_apellidos', TextType::class, [
                'label' => 'Apellidos del perfil',
                'required' => false,
                'property_path' => 'perfil.apellidos',
                'attr' => [
                    'class' => 'form-control'
                ],
                'label_attr' => [
                    'style' => 'font-weight: bold; margin-top: 2em;'
                ]
            ])
            ->add('perfil_peso', NumberType::class, [
                'label' => 'Peso del perfil',
                'required' => false,
                'property_path' => 'perfil.peso',
                'attr' => [
                    'class' => 'form-control'
                ],
                'label_attr' => [
                    'style' => 'font-weight: bold; margin-top: 2em;'
                ]
            ])
            ->add('perfil_altura', NumberType::class, [
                'label' => 'Altura del perfil',
                'required' => false,
                'property_path' => 'perfil.altura',
                'attr' => [
                    'class' => 'form-control'
                ],
                'label_attr' => [
                    'style' => 'font-weight: bold; margin-top: 2em;'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
