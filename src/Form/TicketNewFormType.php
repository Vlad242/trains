<?php

namespace App\Form;

use App\Entity\Schedule;
use App\Entity\Ticket;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class TicketNewFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('schedule', EntityType::class, [
                'class' => Schedule::class,
                'choice_label' => 'id',
                'label' => 'Рейс:',
                'required' => true
            ])
            ->add('price', NumberType::class, [
                'label' => 'Ціна:',
                'required' => true
            ])
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Звичайний' => 'Звичайний',
                    'Студентський' => 'Студентський',
                    'Пільговий' => 'Пільговий'
                ],
                'label' => 'Тип квитка:',
                'required' => true
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Додаткова інформація:',
                'required' => true
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ticket::class,
        ]);
    }
}
