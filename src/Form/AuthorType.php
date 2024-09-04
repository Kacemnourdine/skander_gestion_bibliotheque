<?php

namespace App\Form;

use App\Entity\Author;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class AuthorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class,[
                'label'=>'Name :',
                'attr'=>[
                    'placeholder'=>'',
                    'class'=>'form-control'
                ]
            ])
            ->add('biography',TextareaType::class,[
                'label'=>'Biography :',
                'attr'=>[
                    'placeholder'=>'',
                    'class'=>'form-control'
                ]
            ])
            ->add('birthdate', DateType::class, [
                'label'=>'Birthdate :',
                'widget' => 'choice',
                'input'  => 'datetime'
            ])
           ->add('nationality',TextType::class,[
                'label'=>'Nationality :',
                'attr'=>[
                    'placeholder'=>'',
                    'class'=>'form-control'
                ]
            ])
            ->add('Save', SubmitType::class,[
               'attr'=> [
                'class'=>'btn btn-primary mt-2',
               ]
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Author::class,
        ]);
    }
}
