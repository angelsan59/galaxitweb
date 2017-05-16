<?php

namespace San\OffresBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use San\OffresBundle\Repository\CategorieRepository;

class CompetenceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom',     TextType::class)
               ->add('content',     TextareaType::class, array('label' => 'Description', 'required' => false))
                 ->add('categorie', EntityType::class, array(
                    'class'        => 'SanOffresBundle:Categorie',
                    'choice_label' => 'nom',
                    'multiple'     => false,
                     'expanded' => true,
                     'query_builder' => function (CategorieRepository $er) {
        return $er->createQueryBuilder('u')
                     ->orderBy('u.nom', 'ASC');}
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
            'data_class' => 'San\OffresBundle\Entity\Competence'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'san_offresbundle_competence';
    }


}
