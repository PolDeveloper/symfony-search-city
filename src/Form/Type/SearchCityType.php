<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\CallbackTransformer;

class SearchCityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('city', TextType::class, array(
                  'label' => 'City ',
                  'attr' => array(
                      'placeholder' => 'City'
                  )
            ))
            ->add('street', TextType::class, array(
                  'label' => 'Street ',
                  'attr' => array(
                      'placeholder' => 'Street'
                  )
            ))
            ->add('postcode', TextType::class, array(
                  'label' => 'Postcode ',
                  'attr' => array(
                      'placeholder' => 'XX-XXX'
                  )
            ))
            ->add('Search', SubmitType::class, ['attr' => ['class' => 'btn btn-success']])
            ->setRequired(false)
        ;
        $builder->get('city')
            ->addModelTransformer(new CallbackTransformer(
                function ($ucFirst) {
                    return ucfirst(strtolower($ucFirst ?? ''));
                },
                function ($ucFirst) {
                   return ucfirst(strtolower($ucFirst ?? ''));
                }
            ))
        ;
    }
}