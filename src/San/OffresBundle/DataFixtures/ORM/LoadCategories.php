<?php

namespace San\OffresBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use San\OffresBundle\Entity\Categorie;
/**
 * Description of LoadStatuts
 *
 * @author Dev
 */
class LoadCategories  implements FixtureInterface
{
 // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
  public function load(ObjectManager $manager)
  {
    // Liste des noms de statut à ajouter
    $names = array(
      'Administration systèmes, réseaux et sécurité',
      'Gestion de projet',
      'Langage de développement',
      'Management',
      'Help Desk',
      'Secteur d\'activité',
      'Environnement',
      'GED'
    );

    foreach ($names as $name) {
      
      $categorie = new Categorie();
      $categorie->setNom($name);

      // On la persiste
      $manager->persist($categorie);
    }

    // On déclenche l'enregistrement de tous les statuts
    $manager->flush();
  }
}
