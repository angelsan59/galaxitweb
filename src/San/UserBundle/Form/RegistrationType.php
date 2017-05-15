<?php

namespace San\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Form\Extension\Core\Type\FileType;



class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
               ->add('nom',     TextType::class, array('label' => 'Votre nom'))
                ->add('prenom',     TextType::class, array('label' => 'Votre prénom'))
                ->add('societe',     TextType::class, array('label' => 'Société', 'required' => false))
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