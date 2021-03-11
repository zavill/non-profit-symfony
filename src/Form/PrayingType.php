<?php

namespace App\Form;

use App\Entity\Praying;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PrayingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('FirstName', TextareaType::class, [
                'label' => 'First Name'
            ])
            ->add('LastName', TextareaType::class, [
                'label' => 'Last Name'
            ])
            ->add('Description', TextareaType::class, [
                'label' => 'What is the nature of the prayer request?'
            ])
            ->add('Submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Praying::class,
        ]);
    }
}
