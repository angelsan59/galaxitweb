<?php

namespace San\OffresBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;



class StatutcandType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                 ->add('statut', EntityType::class, array(
                    'class'        => 'SanUserBundle:Statut',
                    'choice_label' => 'nom',
                    'multiple'     => false,
            ))
            ->add('Changer le statut',      SubmitType::class, array(
    'attr' => array('class' => 'btn btn-info btn-xs'),));
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
