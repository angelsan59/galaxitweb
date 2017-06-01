<?php

namespace San\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Form\Extension\Core\Type\FileType;



class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('civilite', ChoiceType::class, array(
             'choices' => array('Madame' => 'Madame', 'Monsieur' => 'Monsieur'),
             'expanded' => true,
             'multiple' => false,
             'label' => 'Civilité',
             'label_attr' => array('class' => 'radio-inline')
     ))
                ->add('nom',     TextType::class, array('label' => 'Votre nom'))
                ->add('prenom',     TextType::class, array('label' => 'Votre prénom'))
                ->add('societe',     TextType::class, array('label' => 'Société', 'required' => false))
                ->add('adresse',     TextType::class, array('label' => 'Adresse'))
                ->add('cp',     TextType::class, array('label' => 'Code Postal'))
                ->add('ville',     TextType::class, array('label' => 'Ville'))
                ->add('pays',     CountryType::class, array(
                    'label' => 'Pays',
                    'preferred_choices' => array('FR')))
                ->add('telephone',     TextType::class, array('label' => 'Téléphone'))
                ->add('portable',     TextType::class, array('label' => 'Portable', 'required' => false))
                ->add('imagefile', FileType::class, array('label' => 'Photo ou avatar', 'required' => false))
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