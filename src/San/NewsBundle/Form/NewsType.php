<?php

namespace San\NewsBundle\Form;

use Symfony\Component\Form\AbstractType;
use San\CoreBundle\Form\ImageType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class NewsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('titre',     TextType::class)
            ->add('content',   TextareaType::class)
            ->add('image',     ImageType::class)
            ->add('published', CheckboxType::class, array('label' => 'Publié', 'required' => false))
            ->add('newscats', EntityType::class, array(
                    'class'        => 'SanNewsBundle:NewsCat',
                    'choice_label' => 'nom',
                    'multiple'     => true,
            ))
           
            ->add('Enregistrer',      SubmitType::class);
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
