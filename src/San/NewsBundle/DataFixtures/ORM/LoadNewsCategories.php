<?php

namespace San\NewsBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use San\NewsBundle\Entity\NewsCat;
/**
 * Description of LoadNewscategories
 *
 * @author Dev
 */
class LoadNewsCategories  implements FixtureInterface
{
 // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
  public function load(ObjectManager $manager)
  {
    // Liste des noms de statut à ajouter
    $names = array(
      'Actualité',
      'Technologie',
      'Evènement',
      'Témoignage',
      'Opportunité'
    );

    foreach ($names as $name) {
      
      $newscat = new NewsCat();
      $newscat->setNom($name);

      // On la persiste
      $manager->persist($newscat);
    }

    // On déclenche l'enregistrement de tous les statuts
    $manager->flush();
  }
}
