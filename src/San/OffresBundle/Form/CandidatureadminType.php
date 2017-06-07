<?php

namespace San\OffresBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Form\Type\VichImageType;
use San\OffresBundle\Repository\CompetenceRepository;
use San\OffresBundle\Repository\CategorieRepository;
/**
 * Description of CandidatureadminType
 *
 * @author Dev
 */
class CandidatureadminType extends AbstractType {
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('dateDispo',      DateType::class, array(
                    'label' => 'Date de disponibilité', 
                    'widget' => 'single_text', 
                    'html5' => false,
                    'format' => 'dd-mm-yyyy',
                    'attr' => ['class' => 'js-datepicker'],))
                ->add('content', TextareaType::class, array('label' => 'Présentez-vous (Par ex. web développer, 5 ans d\'expérience)'))
                 ->add('contrats', EntityType::class, array(
                    'class'        => 'SanOffresBundle:Contrat',
                    'label' => 'Type de contrat recherché',
                    'choice_label' => 'nom',
                    'multiple'     => true,
                    'expanded'     => true,
            ))
               
                ->add('web',     TextType::class, array('label' => 'Site web', 'required' => false))
                ->add('linkdn',     TextType::class, array('label' => 'Linkdn', 'required' => false))
                ->add('viadeo',     TextType::class, array('label' => 'Viadeo', 'required' => false))
                ->add('twitter',     TextType::class, array('label' => 'Twitter', 'required' => false))
                ->add('cvFile', FileType::class, array('label' => 'CV', 'required' => false))
                ->add('realisations', CKEditorType::class, array('config_name' => 'my_config', 'label' => 'Réalisations'))
                ->add('formation', CKEditorType::class, array('config_name' => 'my_config', 'label' => 'Formation'))
                ->add('techno', CKEditorType::class, array('config_name' => 'my_config', 'label' => 'Technologies'))
                ->add('evolution', CKEditorType::class, array('config_name' => 'my_config', 'label' => 'Evolution'))
                 
        ->add('competences', EntityType::class, array(
                    'class'        => 'SanOffresBundle:Competence',
                    'label' => 'Compétences (sélectionnez-en autant que vous voulez)',
                    'choice_label' => 'nom',
                    'multiple'     => true,
            'attr'=> array('class'=> 'js-example-basic-multiple'),
                    'expanded' => false,
                     'query_builder' =>  function (CompetenceRepository $er) {
        return $er->createQueryBuilder('cc')
               ->join('cc.categorie', 'cat') //something like that
               ->orderBy('cat.nom', 'ASC')->addOrderBy('cc.nom', 'ASC');
},
                    'group_by' => function($val, $key, $index) {
                    return $val->getCategorie()->getNom();},        
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
