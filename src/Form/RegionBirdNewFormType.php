<?php

namespace App\Form;

use App\Entity\Birds;
use App\Entity\Classification;
use App\Entity\EcoGroup;
use App\Entity\Region;
use App\Entity\RegionBird;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class RegionBirdNewFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('bird', EntityType::class, [
                'class' => Birds::class,
                'choice_label' => 'name',
                'label' => 'Птах:',
                'required' => true
            ])
            ->add('region', EntityType::class, [
                'class' => Region::class,
                'choice_label' => 'name',
                'label' => 'Регіон:',
                'required' => true
            ])
            ->add('population', NumberType::class,[
                'label' => 'Популяція:',
                'required' => true
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
            'data_class' => RegionBird::class,
        ]);
    }
}
