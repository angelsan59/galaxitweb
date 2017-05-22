<?php

namespace San\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
/**
 * Description of ContactType
 *
 * @author Dev
 */
class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('nom', TextType::class)
        ->add('email', EmailType::class)
                ->add('sujet', TextType::class)
                ->add('message', TextareaType::class)
                 ->add('Envoyer',      SubmitType::class, array(
    'attr' => array('class' => 'btn btn-info'),));
    }

    public function getName()
    {
        return 'Contact';
    }
}
