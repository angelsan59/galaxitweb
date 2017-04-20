<?php

namespace San\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom');
    }

    public function getParent()
    {
        return 'fos_user_registration';
    }

    public function getNom()
    {
        return 'app_user_registration';
    }
}