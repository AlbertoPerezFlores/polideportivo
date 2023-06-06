<?php

namespace App\Form;

use App\Entity\HistoricoClases;
use App\Entity\Horario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class HistoricoClasesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fecha_Actividad')
            ->add('HoraActividad')
            ->add('actividad')
            ->add('usuario')
            ->add('Horario', EntityType::class, [
                'class' => Horario::class,
                'choice_label' => 'id', // Reemplaza 'nombre' por el nombre de la propiedad que deseas mostrar en la lista desplegable
                'placeholder' => 'Seleccione un horario', // Opcional: agrega un marcador de posición en la lista desplegable
            ])
            ->add('Sala')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => HistoricoClases::class,
             'csrf_protection' => false,
            // 'csrf_field_name' => '_tokenHC',
            // // a unique key to help generate the secret token
            // 'csrf_token_id'   => 'autenticaHC',
        ]);
    }
}
