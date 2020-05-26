<?php

namespace App\Form;

use App\Entity\Points;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class PointNewFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description', TextareaType::class, [
                'label' => 'Опис точки:',
                'attr' => [
                    'rows' => 8
                ]
            ])
            ->add('pointX', TextType::class, [
                'label' => 'pointX:',
                'required' => true
            ])
            ->add('pointY', TextType::class, [
                'label' => 'pointY:',
                'required' => true
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Points::class,
        ]);
    }
}
