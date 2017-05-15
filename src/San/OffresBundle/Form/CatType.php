<?php

namespace San\OffresBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use San\OffresBundle\Repository\CompetenceRepository;
use Symfony\Bridge\Doctrine\Form\Type\CollectionType;
/**
 * Description of CatType
 *
 * @author Dev
 */
class CatType extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('competences', CollectionType::class, array(
                    'class'        => 'SanOffresBundle:Competence',
                    'choice_label' => 'nom',
                    'multiple'     => true,
                    'query_builder' => function(CompetenceRepository $repository) {
                    return $repository->createQueryBuilder('c')
                                    ->innerJoin('c.categories', 'cat', 'WITH', 'cat.id=:id')
                            ->setParameter('id', 23)
                            ->addSelect('cat')
                            ->orderBy('c.nom');}
            ));
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'San\OffresBundle\Entity\Competence'
    ));
  }
}