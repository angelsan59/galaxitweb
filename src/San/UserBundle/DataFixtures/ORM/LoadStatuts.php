<?php

namespace San\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use San\UserBundle\Entity\Statut;
/**
 * Description of LoadStatuts
 *
 * @author Dev
 */
class LoadStatuts  implements FixtureInterface
{
 // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
  public function load(ObjectManager $manager)
  {
    // Liste des noms de statut à ajouter
    $names = array(
      'nouveau',
      'non retenu',
      'à qualifier',
      'qualifié en étude de rendez-vous',
      'prise de rendez-vous',
        'rendez-vous fixé',
        'vivier',
        'non disponible à garder',
        'vu et à positionner chez client'
    );

    foreach ($names as $name) {
      // On crée la catégorie
      $statut = new Statut();
      $statut->setNom($name);

      // On la persiste
      $manager->persist($statut);
    }

    // On déclenche l'enregistrement de tous les statuts
    $manager->flush();
  }
}
