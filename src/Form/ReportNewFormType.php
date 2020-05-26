<?php

namespace App\Form;

use App\Entity\Analysis;
use App\Entity\Birds;
use App\Entity\Report;
use App\Repository\AnalysisRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ReportNewFormType extends AbstractType
{
    private $analysisRepository;

    public function __construct(AnalysisRepository $analysisRepository)
    {
        $this->analysisRepository = $analysisRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('bird', EntityType::class, [
                'class' => Birds::class,
                'choice_label' => 'name',
                'label' => 'Досліджуваний птах:',
                'required' => true
            ])
            ->add('analysis', EntityType::class, [
                'class' => Analysis::class,
                'choices' => $this->analysisRepository->findByUserId($options['userId']),
                'choice_label' => 'theme',
                'label' => 'Проект аналізу:',
                'required' => true
            ])
            ->add('theme', TextType::class, [
                'label' => 'Заголовок:',
                'required' => true
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Опис звіту:',
                'required' => true
            ])
            ->add('document', FileType::class, [
                'label' => 'Документ звіту (PDF):',
                'required' => true
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Report::class,
        ])->setRequired([
            'userId'
        ]);
    }
}
