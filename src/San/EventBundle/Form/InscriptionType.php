<?php

namespace San\EventBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use San\UserBundle\Form\RegistrationType;

/**
 * Description of InscriptionType
 *
 * @author San
 */
class InscriptionType extends AbstractType {
   public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user',     RegistrationType::class)
            ->add('Enregistrer',      SubmitType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'San\EventBundle\Entity\Inscription'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'san_eventbundle_inscription';
    }
}
