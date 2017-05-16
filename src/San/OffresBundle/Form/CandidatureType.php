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
use San\OffresBundle\Repository\CompetenceRepository;
use San\OffresBundle\Repository\CategorieRepository;

class CandidatureType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('dateDispo',      DateType::class, array('label' => 'Date de disponibilité', 'widget' => 'single_text'))
                ->add('content', TextareaType::class, array('label' => 'Présentez-vous (Par ex. web développer, 5 ans d\'expérience)'))
                 ->add('contrats', EntityType::class, array(
                    'class'        => 'SanOffresBundle:Contrat',
                    'label' => 'Type de contrat recherché',
                    'choice_label' => 'nom',
                    'multiple'     => true,
                    'expanded'     => true,
            ))
                ->add('adresse',     TextType::class, array('label' => 'Adresse'))
                ->add('cp',     TextType::class, array('label' => 'Code Postal'))
                ->add('ville',     TextType::class, array('label' => 'Ville'))
                ->add('pays',     TextType::class, array('label' => 'Pays'))
                ->add('web',     TextType::class, array('label' => 'Site web', 'required' => false))
                ->add('linkdn',     TextType::class, array('label' => 'Linkdn', 'required' => false))
                ->add('viadeo',     TextType::class, array('label' => 'Viadeo', 'required' => false))
                ->add('twitter',     TextType::class, array('label' => 'Twitter', 'required' => false))
                ->add('cvFile', FileType::class, array('label' => 'CV', 'required' => false))
                ->add('realisations', TextareaType::class, array('label' => 'Réalisations'))
                ->add('formation', TextareaType::class, array('label' => 'Formation'))
                ->add('techno', TextareaType::class, array('label' => 'Technologies'))
                ->add('evolution', TextareaType::class, array('label' => 'Evolution'))
                 
        ->add('competences', EntityType::class, array(
                    'class'        => 'SanOffresBundle:Competence',
                    'label' => 'Compétences (sélectionnez-en autant que vous voulez)',
                    'choice_label' => 'nom',
                    'multiple'     => true,
                    'expanded' => false,
                    'group_by' => 'categorie.nom',   
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
