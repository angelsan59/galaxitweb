<?php

namespace San\OffresBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Form\Type\VichImageType;


class CandidatureType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('dateDispo',      DateType::class, array('label' => 'Date de disponibilité', 'widget' => 'single_text'))
                ->add('content', TextareaType::class, array('label' => 'Présentez-vous'))
                 ->add('contrats', EntityType::class, array(
                    'class'        => 'SanOffresBundle:Contrat',
                    'label' => 'Type de contrat recherché',
                    'choice_label' => 'nom',
                    'multiple'     => true,
                    'expanded'     => true,
            ))
                ->add('adresse',     TextType::class)
                ->add('cp',     TextType::class)
                ->add('ville',     TextType::class)
                ->add('pays',     TextType::class)
                ->add('web',     TextType::class)
                ->add('linkdn',     TextType::class)
                ->add('viadeo',     TextType::class)
                ->add('twitter',     TextType::class)
                ->add('cvFile', FileType::class, array('label' => 'CV', 'required' => false))
                ->add('realisations', TextareaType::class)
                ->add('formation', TextareaType::class)
                ->add('techno', TextareaType::class)
                ->add('evolution', TextareaType::class)
                 ->add('categories', EntityType::class, array(
                    'class'        => 'SanOffresBundle:Categorie',
                    'choice_label' => 'nom',
                    'multiple'     => true,
            ))
               
            ->add('competences', EntityType::class, array(
                    'class'        => 'SanOffresBundle:Competence',
                    'choice_label' => 'nom',
                    'multiple'     => true,
            ))
           
            ->add('Enregistrer',      SubmitType::class, array(
    'attr' => array('class' => 'btn btn-info'),));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'San\OffresBundle\Entity\Candidature'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'san_offresbundle_candidature';
    }


}
