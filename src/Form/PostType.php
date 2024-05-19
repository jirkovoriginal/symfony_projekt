<?php

namespace App\Form;

use App\Entity\Prispevek;
use App\Entity\Uzivatel;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nazev', TextType::class, [
                'label' => 'Název Článku'
            ])
            ->add('obsah', TextareaType::class, [
                'label' => 'obsah',
                'attr' => ['rows' => 10]
            ])
            ->add('obrazek1', FileType::class, [
                'label' => false,
                'mapped' => false,
                'required' => false,
                'attr' => ['acceps' => 'image/*'],
                'constrains' => [
                    new Image()
                ]
            ])
            ->add('obrazek2')
            ->add('obrazek3')
            ->add('obrazek4')
            ->add('obrazek5')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Prispevek::class,
        ]);
    }
}
