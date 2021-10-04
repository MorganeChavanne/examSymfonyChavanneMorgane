<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\AtLeastOneOf;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'attr'=>'form-control',
                'placeholder'=>'Prénom'
            ]
            ->add('lastname', TextType::class, [
                'attr'=>'form-control',
                'placeholder'=>'Nom de famille'
            ])
            ->add('picture', TextType::class, [
                'attr'=>'form-control',
                'placeholder'=>'Photo'
            ])
            ->add('email', EmailType::class, [
                'attr'=> 'form-control',
                'placeholder'=>'Email'
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'type' => PasswordType::class,
                'options' => [
                    
                ],
                'first_options' => [
                    'label' => 'Password',
                        'attr' => [
                            'class'=> 'password-field form-control'
                    ]
                ],
                'second_options'=> [
                    'label' => 'Confirmez votre mot de passe',
                        'attr' => [
                            'class'=> 'password-field form-control'
                    ]
                        ],
                'invalid_message' => 'Les mots de passes ne sont pas identiques',
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci d\entrer un mot de passe',
                    ]),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Votre mot de passe doit contenir, au minimum, {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                    new AtLeastOneOf([
                        'min' => 1,
                        'minMessage' => 'Votre mot de passe doit contenir, au minimum, {{ limit }} lettres',
                        'max' => 1024,
                    ]),
                    new AtLeastOneOf([
                        'min' => 1,
                        'minMessage' => 'Votre mot de passe doit contenir, au minimum, {{ limit }} chiffres',
                        'max' => 1024,
                    ]), 
                                  
                ],
            ])


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
            