<?php

namespace App\Form;

use App\Entity\Rest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RestFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('text', TextType::class, ['label' => false, 'required' => false])
            ->add('minZahl', TextType::class, ['label' => false])
            ->add('maxZahl', TextType::class, ['label' => false])
            ->add('Los', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Rest::class,
        ]);
    }
}
