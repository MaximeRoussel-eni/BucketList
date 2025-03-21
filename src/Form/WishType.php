<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Wish;
use Doctrine\ORM\Query\Expr\Select;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WishType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options):void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre',
                'attr' => ['class' => 'form-control']
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'required' => false,
                'attr' => ['class' => 'form-control']
            ])

            ->add('isPublished', CheckboxType::class, [
                'label' => 'Publié ?',
                'required' => false,
                'attr' => ['class' => 'form-check-input']
            ])
            /*->add('save', SubmitType::class, [
                'label' => 'Créer',
                'attr' => ['class' => 'btn btn-primary']
            ])*/
            ->add('Category', EntityType::class, [
                'class' => Category::class,
                'choice_label'=>'name',
                'label'=>'Categorie',
            ]);
    }
    public function configureOptions(OptionsResolver $resolver):void
    {
       $resolver->setDefaults([
           'data_class'=>Wish::class,
       ]);
    }

}