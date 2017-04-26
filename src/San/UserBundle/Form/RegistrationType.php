<?php

namespace San\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                
               ->add('nom',     TextType::class, array('label' => 'Votre nom'))
                ->add('prenom',     TextType::class, array('label' => 'Votre prénom'))
                ->add('societe',     TextType::class, array('label' => 'Société'))
                ->add('telephone',     TextType::class, array('label' => 'Téléphone'))
                ->add('portable',     TextType::class, array('label' => 'Portable'))
       ;
    }

     public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

     public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

}