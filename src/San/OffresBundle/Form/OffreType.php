<?php

namespace San\OffresBundle\Form;

use Symfony\Component\Form\AbstractType;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
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
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use San\OffresBundle\Repository\CompetenceRepository;

class OffreType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
   
            ->add('fin',      DateType::class, array('label' => 'Fin de validité', 'widget' => 'single_text'))
            ->add('titre',     TextType::class)
            ->add('content', CKEditorType::class, array('config_name' => 'my_config',
))
            ->add('mission', CKEditorType::class, array('config_name' => 'my_config',
))
            ->add('formation', CKEditorType::class, array('config_name' => 'my_config',
))
            ->add('imagefile', FileType::class, array('label' => 'Image', 'required' => false))
            ->add('published', CheckboxType::class, array('label' => 'Publié', 'required' => false))
            ->add('contrat', EntityType::class, array(
                    'class'        => 'SanOffresBundle:Contrat',
                    'choice_label' => 'nom',
                    'multiple'     => false,
            ))
            ->add('categories', EntityType::class, array(
                    'class'        => 'SanOffresBundle:Categorie',
                    'choice_label' => 'nom',
                    'multiple'     => true,
            ))
            ->add('competences', EntityType::class, array(
                    'class'        => 'SanOffresBundle:Competence',
                    'label' => 'Compétences (sélectionnez-en autant que vous voulez)',
                    'choice_label' => 'nom',
                    'multiple'     => true,
                    'expanded' => false,
                'query_builder' => function(CompetenceRepository $er)
            {
            return $er->createQueryBuilder('u')
                                        ->orderBy('u.nom', 'ASC');
            },
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
            'data_class' => 'San\OffresBundle\Entity\Offre'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'san_offresbundle_offre';
    }


}
