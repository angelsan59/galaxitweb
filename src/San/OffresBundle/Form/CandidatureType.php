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
                ->add('web',     TextType::class, array('label' => 'Site web'))
                ->add('linkdn',     TextType::class, array('label' => 'Linkdn'))
                ->add('viadeo',     TextType::class, array('label' => 'Viadeo'))
                ->add('twitter',     TextType::class, array('label' => 'Twitter'))
                ->add('cvFile', FileType::class, array('label' => 'CV', 'required' => false))
                ->add('realisations', TextareaType::class, array('label' => 'Réalisations'))
                ->add('formation', TextareaType::class, array('label' => 'Formation'))
                ->add('techno', TextareaType::class, array('label' => 'Technologies'))
                ->add('evolution', TextareaType::class, array('label' => 'Evolution'))
                 ->add('categories', EntityType::class, array(
                    'class'        => 'SanOffresBundle:Categorie',
                    'choice_label' => 'nom',
                    'multiple'     => true,
            ))
        ->add('competences', EntityType::class, array(
                    'class'        => 'SanOffresBundle:Competence',
                    'choice_label' => 'nom',
                    'multiple'     => true,
                    'query_builder' => function(CompetenceRepository $repository) {
                    return $repository->createQueryBuilder('c')
                                    ->innerJoin('c.categories', 'cat', 'WITH', 'cat.id=:id')
                            ->setParameter('id', 22)
                            ->addSelect('cat')
                            ->orderBy('c.nom');}
            ))
                            ->add('comp',     CatType::class)
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
