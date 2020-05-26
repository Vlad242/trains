<?php

namespace App\Form;

use App\Entity\Birds;
use App\Entity\Classification;
use App\Entity\EcoGroup;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class BirdsNewFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ecoGroup', EntityType::class, [
                'class' => EcoGroup::class,
                'choice_label' => 'name',
                'label' => 'Еко група:',
                'required' => true
            ])
            ->add('classification', EntityType::class, [
                'class' => Classification::class,
                'choice_label' => 'name',
                'label' => 'Класифікація:',
                'required' => true
            ])
            ->add('name', TextType::class, [
                'label' => 'Назва:',
                'required' => true
            ])
            ->add('age', NumberType::class,[
                'label' => 'Вік:',
                'required' => true
            ])
            ->add('gender', ChoiceType::class, [
                'choices'  => [
                    'Male' => 'M',
                    'Famale' => 'F'
                ],
                'label' => 'Стать:',
                'required' => true
            ])
            ->add('image', FileType::class, [
                'label' => 'Файл зображення:',
                'required' => true
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Birds::class,
        ]);
    }
}
