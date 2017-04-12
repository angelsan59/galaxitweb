<?php

namespace San\OffresBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use San\OffresBundle\Entity\Contrat;
/**
 * Description of LoadStatuts
 *
 * @author Dev
 */
class LoadContrats  implements FixtureInterface
{
 // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
  public function load(ObjectManager $manager)
  {
    // Liste des noms de statut à ajouter
    $names = array(
      'CDD',
      'CDI',
      'CDI pré-embauche',
      'mission courte',
      'freelance'
    );

    foreach ($names as $name) {
      
      $contrat = new Contrat();
      $contrat->setNom($name);

      // On la persiste
      $manager->persist($contrat);
    }

    // On déclenche l'enregistrement de tous les statuts
    $manager->flush();
  }
}
