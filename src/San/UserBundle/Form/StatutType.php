<?php

namespace San\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class StatutType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom',     TextType::class, array('label' => 'Nom'))
                ->add('cvtheque',     CheckboxType::class, array(
                    'label' => 'Cochez pour que le statut apparaisse dans la CVthèque', 'required' => false))
               ->add('content',     TextareaType::class, array('label' => 'Description', 'required' => false))
                ->add('Enregistrer',      SubmitType::class, array(
    'attr' => array('class' => 'btn btn-info'),));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'San\UserBundle\Entity\Statut'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'san_userbundle_statut';
    }


}
