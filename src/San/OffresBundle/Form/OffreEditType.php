<?php

namespace San\OffresBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class OffreEditType extends AbstractType
{
     public function buildForm(FormBuilderInterface $builder, array $options)
  {
   
  }

  public function getParent()
  {
    return OffreType::class;
  }
}
