<?php

namespace App\Form;

use App\Entity\Book;
use App\Entity\Borrower;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bridge\Doctrine\Form\Type\ChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextAreaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class BorrowerType extends AbstractType
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
            ->add('email',TextType::class,[
                'label'=>'Name :',
                'attr'=>[
                    'placeholder'=>'',
                    'class'=>'form-control'
                ]
            ])
            ->add('phoneNumber',NumberType::class,[
                'label'=>'phone Number :',
                'attr'=>[
                    'placeholder'=>'',
                    'class'=>'form-control'
                ],
                'html5'=> true,
            ])
            ->add('borrowedBooks', EntityType::class, [
                'class' => Book::class,
                /*'query_builder' => function (EntityRepository $er): QueryBuilder {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.id', 'ASC');
                },
                */
                'choice_label' => 'id',
                'multiple' => true,
                'attr' => [
                    'class' => 'form-control'
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
            'data_class' => Borrower::class,
        ]);
    }
}
