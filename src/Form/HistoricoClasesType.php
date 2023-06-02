<?php

namespace App\Form;

use App\Entity\HistoricoClases;
use App\Entity\Horario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HistoricoClasesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fecha_Actividad')
            ->add('HoraActividad')
            ->add('actividad')
            ->add('usuario')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => HistoricoClases::class,
            // 'csrf_protection' => true,
            // 'csrf_field_name' => '_tokenHC',
            // // a unique key to help generate the secret token
            // 'csrf_token_id'   => 'autenticaHC',
        ]);
    }
}
