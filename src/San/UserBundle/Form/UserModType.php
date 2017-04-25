<?php

namespace San\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class UserModType extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->remove('dateInsc');
  }

  public function getParent()
  {
    return UserType::class;
  }
}
