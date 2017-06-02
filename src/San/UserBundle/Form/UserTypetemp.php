<?php

namespace San\UserBundle\Form;

use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use FOS\UserBundle\Util\LegacyFormHelper;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Form\Type\VichImageType;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
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
                ->add('email', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\EmailType'), array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle'))
            ->add('username', null, array('label' => 'form.username', 'translation_domain' => 'FOSUserBundle'))
            ->add('plainPassword', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\RepeatedType'), array(
                'type' => LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\PasswordType'),
                'options' => array('translation_domain' => 'FOSUserBundle'),
                'first_options' => array('label' => 'form.password'),
                'second_options' => array('label' => 'form.password_confirmation'),
                'invalid_message' => 'fos_user.password.mismatch',
            ))
                ->add('adresse',     TextType::class, array('label' => 'Adresse'))
                ->add('cp',     TextType::class, array('label' => 'Code Postal'))
                ->add('ville',     TextType::class, array('label' => 'Ville'))
                ->add('pays',     CountryType::class, array(
                    'label' => 'Pays',
                    'preferred_choices' => array('FR')))
                ->add('portable')
                ->add('telephone')
                ->add('imagefile', FileType::class, array('label' => 'Image', 'required' => false))
                ->add('Enregistrer',      SubmitType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'San\UserBundle\Entity\User',
            'csrf_token_id' => 'registration', 
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'san_userbundle_user';
    }


}
