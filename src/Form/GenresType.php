<?php

namespace App\Form;

use App\Entity\Genres;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class GenresType extends AbstractType
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
            'data_class' => Genres::class,
        ]);
    }
}
