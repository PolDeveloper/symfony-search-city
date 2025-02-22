<?php

/**
 * All Rights Reserved
 * @copyright Copyright (C) Michal Talar
 */

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\CallbackTransformer;

class SearchCityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('city', TextType::class, [
                'label' => 'City ',
                'attr' => [
                    'placeholder' => 'City',
                ],
            ])
            ->add('street', TextType::class, [
                'label' => 'Street ',
                'attr' => [
                    'placeholder' => 'Street',
                ],
            ])
            ->add('postcode', TextType::class, [
                'label' => 'Postcode ',
                'attr' => [
                    'placeholder' => 'XX-XXX',
                ],
            ])
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
                },
            ))
        ;
    }
}
