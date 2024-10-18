<?php

namespace App\Form;

use App\Entity\BOOKING;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('check_in_at', DateType::class, [
                'attr' => [
                    'id' => 'check_in_at',
                ],
                'widget' => 'single_text',
            ])
            ->add('check_out_at', DateType::class, [
                'attr' => [
                    'id' => 'check_out_at',
                ],
                'widget' => 'single_text',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BOOKING::class,
        ]);
    }
}
