<?php

namespace San\OffresBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

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
            ->add('content',   TextareaType::class)
            ->add('mission',   TextareaType::class)
            ->add('formation',   TextareaType::class)
            ->add('published', CheckboxType::class, array('label' => 'Publié', 'required' => false))
            ->add('Enregistrer',      SubmitType::class)
            ->add('auteurid', HiddenType::class, array('data' => '1'));
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
