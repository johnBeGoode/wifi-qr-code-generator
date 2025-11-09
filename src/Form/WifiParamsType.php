<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class WifiParamsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('networkName', TextType::class, [
                'required' => false,
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 6])
                ]
            ])
            ->add('encryption', ChoiceType::class, [
                'choices' => [
                    'WEP' => 'WEP',
                    'WPA' => 'WPA',
                    'WPA2' => 'WPA2'
                ],
                'help' => 'The type of security protocol on your network'
            ])
            ->add('password', PasswordType::class, [
                'required' => false,
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 8])
                ]

            ])
            ->add('isHidden', CheckboxType::class, [
                'label' => 'Hidden wifi network',
                'required' => false, 
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
