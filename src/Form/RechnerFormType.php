<?php

namespace App\Form;


use App\Entity\Rechner;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Button;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\Form\SubmitButton;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RechnerFormType extends AbstractType implements FormTypeInterface
{

    function setErgebnis($erg){
        $this->ergebnis = $erg;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if(!isset($ergebnis)){$this->ergebnis = 0;}
        $atr = [$this->ergebnis];
        $builder
            ->add('zahl', TextareaType::class, ['attr' => $atr, 'label' => false])
            ->add('Rechenart', ChoiceType::class, [ 'label' => false,
                'choices'  => [
                    'Minus' => false,
                    'Plus' => true,
                ],
            ]);
            $builder->add('Calc', ButtonType::class);
            $builder->add('Los',  SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Rechner::class,
        ]);
    }
}
