<?php

namespace App\Form;

use App\Entity\Actividades;
use App\Entity\Horario;
use App\Entity\Sala;
use App\Entity\dias;
use App\Entity\HoraHorario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class HorarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Capacidad', NumberType::class, [
                'label' => 'Cupo de la clase',
                'required' => true,
                'attr' => [
                    'class' => 'form-control'
                ],
                'label_attr' => [
                    'style' => 'font-weight: bold; margin-top: 2em;'
                ]
            ])
            ->add('Actividad', EntityType::class,[
                'label' => 'Actividad',
                'class' => Actividades::class,
                'choice_label' => 'Actividad', 
                'required' => true,
                'attr' => [
                    'class' => 'form-control'
                ],
                'label_attr' => [
                    'style' => 'font-weight: bold; margin-top: 2em;'
                ]
            ])
            ->add('Sala', EntityType::class,[
                'label' => 'Sala',
                'class' => Sala::class,
                'choice_label' => 'nombre_sala', 
                'required' => true,
                'attr' => [
                    'class' => 'form-control'
                ],
                'label_attr' => [
                    'style' => 'font-weight: bold; margin-top: 2em;'
                ]
            ])
            ->add('Hora', EntityType::class,[
                'label' => 'Hora',
                'class' => HoraHorario::class,
                'choice_label' => function (HoraHorario $horaHorario) {
                    return $horaHorario->getHoraAsString();
                },
                'required' => true,
                'attr' => [
                    'class' => 'form-control'
                ],
                'label_attr' => [
                    'style' => 'font-weight: bold; margin-top: 2em;'
                ]
            ])
            ->add('Dia', EntityType::class,[
                'label' => 'Dia',
                'class' => dias::class,
                'choice_label' => 'Dia', 
                'required' => true,
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
            'data_class' => Horario::class,
        ]);
    }
}
