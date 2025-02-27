<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotCompromisedPassword;
use Symfony\Component\Validator\Constraints\PasswordStrength;

class UpdatePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'password',
                RepeatedType::class,
                [
                    'type' => PasswordType::class,
                    'invalid_message' => '',
                    'required' => true,
                    'mapped' => false,
                    'first_options' => [
                        'label' => 'Heslo',
                        'constraints' => [
                            new Length([
                                'min' => 8,
                                'minMessage' => 'Tvé heslo musí obsahovat alespoň {{ limit }} znaků.',
                                // max length allowed by Symfony for security reasons
                                'max' => 4096,
                            ]),
                        new PasswordStrength(),
                        new NotCompromisedPassword(),
                        ]
                    ],

                    'first_options' => ['label' => 'Zadejte heslo:'],
                    'second_options' => ['label' => 'Opakujte heslo znovu:  ']
                ]
            )
            ->add(
                'submit',
                SubmitType::class,
                ['label' => 'Změnit heslo']
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}