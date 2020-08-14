<?php

namespace App\Form;


use App\Entity\Rechner;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Button;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\Form\SubmitButton;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RechnerFormType extends AbstractType implements FormTypeInterface
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('zahl')
            ->add('Minus', ButtonType::class)
            ->add('Plus', ButtonType::class)
            ->add('GO', SubmitType::class)
            ->add('attending', ChoiceType::class, [
                'choices'  => [
                    'Nope' => false,
                    'Yes' => true,
                ],
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Rechner::class,
        ]);
    }
}
