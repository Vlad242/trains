<?php

namespace App\Form;

use App\Entity\Analysis;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class AnalysisNewFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('theme', TextType::class, [
                'label' => 'Тема:',
                'required' => true
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Опис:',
                'required' => true
            ])
            ->add('map', FileType::class, [
                'label' => 'Карта дослідження:',
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
            'data_class' => Analysis::class,
        ]);
    }
}
