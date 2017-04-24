<?php

namespace San\EventBundle\Form;

use Symfony\Component\Form\AbstractType;
use San\CoreBundle\Form\ImageType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class EventType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
   
            ->add('eventDate', DateType::class, array('label' => 'Date', 'widget' => 'single_text'))
            ->add('fin', DateType::class, array('label' => 'Fin de validité', 'widget' => 'single_text'))
            ->add('titre',     TextType::class)
            ->add('adresse',     TextType::class)
            ->add('content',   TextareaType::class)
            ->add('image',     ImageType::class, array('required' => false))
            ->add('published', CheckboxType::class, array('label' => 'Publié', 'required' => false))
            ->add('Enregistrer',      SubmitType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'San\EventBundle\Entity\Event'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'san_eventbundle_event';
    }


}
