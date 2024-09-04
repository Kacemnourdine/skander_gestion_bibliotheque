<?php

namespace App\Form;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Genres;
use App\Entity\Borrower;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextAreaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;




class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title',TextType::class,[
                'label'=>'Title :',
                'attr'=>[
                    'placeholder'=>'',
                    'class'=>'form-control'
                ]
            ])
            ->add('isbn',TextType::class,[
                'label'=>'ISBN :',
                'attr'=>[
                    'placeholder'=>'',
                     
                    'class'=>'form-control'
                ]
            ])
            ->add('nbrepage',NumberType::class,[
                'label'=>'Nbre Pages :',
                'attr'=>[
                    'placeholder'=>'',
                    'min'=> 1,
                    'max'=> 10000,
                    'class'=>'form-control'
                ],                
                'html5'=> true,
            ])
            ->add('publishedAt', DateType::class, [
                'label'=>'publishedAt :',
                'widget' => 'choice',
                'input'  => 'datetime'
            ])
            ->add('author', EntityType::class, [
                'class' => Author::class,
                'query_builder' => function (EntityRepository $er): QueryBuilder {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.name', 'ASC');
                },
                'choice_label' => 'name',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('genres', EntityType::class, [
                'class' => Genres::class,
                'query_builder' => function (EntityRepository $er): QueryBuilder {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.name', 'ASC');
                },
                'choice_label' => 'name',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
           
            // ->add('borrowers', EntityType::class, [
            //     'class' => Borrower::class,
            //     'choice_label' => 'id',
            //     'multiple' => true,
            // ])
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
            'data_class' => Book::class,
        ]);
    }
}
