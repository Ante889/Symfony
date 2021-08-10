<?php

namespace App\Form;

use App\Entity\Products;
use Doctrine\Common\Collections\Expr\Value;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, [
                'attr' => [
                    'placeholder' => 'Set Title'
                ],
            ]) 
            ->add('author', null, [
                'attr' => [
                    'placeholder' => 'Set Author'
                ],
            ]) 
            ->add('image', null, [
                'attr' => [
                    'placeholder' => 'Add image'
                ],
            ]) 
            ->add('price', null, [
                'attr' => [
                    'placeholder' => 'Set Price'
                ],
            ]) 
            ->add('category', null, [
                'attr' => [
                    'placeholder' => 'Add category'
                ],
            ]) 
            ->add('quantity', null, [
                'attr' => [
                    'placeholder' => 'Add quantity'
                ],
            ]) 
            ->add('content', null, [
                'attr' => [
                    'placeholder' => 'Write content'
                ],
            ]) 
            ->add('Create', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Products::class,
        ]);
    }
}
