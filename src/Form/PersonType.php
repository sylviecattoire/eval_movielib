<?php

namespace App\Form;

use App\Entity\Person;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lastname', null, [
                'label' => 'Nom (ou nom de scène)',
            ])
            ->add('firstname', null, [
                'label' => 'Prénom',
            ])
            ->add('dateOfBirth', null, [
                'label' => 'Date de naissance',
                'widget' => 'single_text',
                'input' => 'datetime',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Person::class,
            // 'attr' => [
            //    'novalidate' => 'novalidate' 
            // ]
        ]);
    }
}
