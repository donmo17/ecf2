<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' => [
                    'placeholder' => 'monemail@gmail.com',
                ],
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Mot de passse'
            ])
            ->add('confirmPassword', PasswordType::class, [
                'label' => 'Confirmer le mot de passse',
                'mapped' => false,
            ])
            ->add('firstName', TextType::class, [
                'required' => false,
                'label' => 'Prénom',
                'attr' => [
                    'placeholder' => 'John',
                ],
            ])
            ->add('lastName', TextType::class, [
                'required' => false,
                'label' => 'Nom',
                'attr' => [
                    'placeholder' => 'DOE',
                ],
            ])
            ->add('address', TextType::class, [
                'required' => false,
                'label' => 'Adresse',
                'attr' => [
                    'placeholder' => '1 rue du Lac',
                ],
            ])
            ->add('zipCode', TextType::class, [
                'required' => false,
                'label' => 'Code postal',
                'attr' => [
                    'placeholder' => '54000',
                ],
            ])
            ->add('city', TextType::class, [
                'required' => false,
                'label' => 'Ville',
                'attr' => [
                    'placeholder' => 'Nancy',
                ],
            ])
            ->add('image', UrlType::class, [
                'required' => false,
                'label' => 'Image de profil',
                'attr' => [
                    'placeholder' => 'https://...',
                ],
            ])
            ->add('submit', SubmitType::class, [
                "label" => "M'inscrire",
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
