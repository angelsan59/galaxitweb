<?php

namespace San\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Form\Type\VichImageType;

/**
 * Description of DateRdvType
 *
 * @author Dev
 */
class DateRdvType extends AbstractType {
 
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->remove('dateInsc')
                 ->add('dateRdv',      DateTimeType::class, array(
                    'label' => 'Date de rendez vous', 
                    'widget' => 'single_text', 
                    'html5' => false,
                    'format' => 'dd-MM-yyyy hh:mm',
                    'attr' => ['class' => 'form_datetime'],))
            ->add('Enregistrer le rendez vous',      SubmitType::class, array(
    'attr' => array('class' => 'btn btn-info btn-xs'),));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'San\UserBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'san_userbundle_user';
    }


}
