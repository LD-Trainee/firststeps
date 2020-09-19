<?php

namespace App\Form;

use App\Entity\NicApiView;
use App\Entity\NicApiViewVersion2;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\SubmitButton;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NicApiViewFormTypeVersion2 extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('NgrokURL', TextType::class, [ 'label' => false])
            ->add('input', TextType::class, [ 'label' => false, "attr" => [ "class" => "InputTextFeld"]])
            ->add('delete', TextType::class, [ 'label' => false,  'required' => false])
            ->add('fragSie', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => NicApiViewVersion2::class,
        ]);
    }
}
