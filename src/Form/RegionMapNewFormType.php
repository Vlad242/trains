<?php

namespace App\Form;

use App\Entity\Region;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class RegionMapNewFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Назва зони:',
                'required' => true
            ])
            ->add('area', NumberType::class,[
                'label' => 'Площа:',
                'required' => true
            ])
            ->add('climate', TextareaType::class,[
                'label' => 'Клімат:',
                'attr' => [
                    'rows' => 8
                ]
            ])
            ->add('soilChar', TextareaType::class,[
                'label' => 'Характеристика грунтів:',
                'attr' => [
                    'rows' => 8
                ]
            ])
            ->add('animalChar', TextareaType::class,[
                'label' => 'Характеристика тварин:',
                'attr' => [
                    'rows' => 8
                ]
            ])
            ->add('plantsChar', TextareaType::class,[
                'label' => 'Характеристика рослинності:',
                'attr' => [
                    'rows' => 8
                ]
            ])
            ->add('image', FileType::class, [
                'label' => 'Файл зображення:',
                'required' => true
            ])
            ->add('polygon', TextType::class, [
                'label' => 'Формула полігону:',
                'required' => true
            ])
            ->add('pointX', TextType::class, [
                'label' => 'Точка центру Х:',
                'required' => true
            ])
            ->add('pointY', TextType::class, [
                'label' => 'точка центру У:',
                'required' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Region::class,
        ]);
    }
}
