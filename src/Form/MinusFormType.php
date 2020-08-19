<?php

namespace App\Form;

use App\Entity\Minus;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MinusFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('zahlminus')
            ->add('feld', HiddenType::class)
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
            'data_class' => Minus::class,
        ]);
    }


}
