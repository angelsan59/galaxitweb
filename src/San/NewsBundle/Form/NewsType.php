<?php

namespace San\NewsBundle\Form;

use Symfony\Component\Form\AbstractType;
use San\CoreBundle\Form\ImageType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;

class NewsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('titre',     TextType::class)
            ->add('content', CKEditorType::class, array('config_name' => 'my_config',
))
            ->add('imagefile', FileType::class, array('label' => 'Image', 'required' => false))
            ->add('published', CheckboxType::class, array('label' => 'Publié', 'required' => false))
            ->add('newscats', EntityType::class, array(
                    'class'        => 'SanNewsBundle:Newscat',
                    'choice_label' => 'nom',
                    'label' => 'Catégorie',
                    'multiple'     => true,
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
            'data_class' => 'San\NewsBundle\Entity\News'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'san_newsbundle_news';
    }


}
