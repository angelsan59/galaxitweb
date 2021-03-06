<?php

namespace San\OffresBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use San\OffresBundle\Entity\Competence;
/**
 * Description of LoadStatuts
 *
 * @author Dev
 */
class LoadCompetences  implements FixtureInterface
{
 // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
  public function load(ObjectManager $manager)
  {
    // Liste des noms de statut à ajouter
    $names = array(
        'VMWARE',
        'Gestion des ressources systèmes et comptes utilisateurs',
        'Implémentation',
        'Architecture réseau',
        'Active Directory',
        'LAN',
        'WAN',
        'VLAN',
        'Administration systèmes',
        'Linux',
        'Windows',
        'Oracle ',
        'Mac OS',
        'Sauvegarde',
        'Sécurité IT',
        'Méthode EBIOS',
        'Firewall',
        'Cisco',
        'Fortinet',
        'F5 Network',
        'Palo Alto',
        'Varonis',
        'OVM',
        'Tivoli',
        'Citrix',
        'Oracle/SOA',
        'Flux Ficovie',
        'DSN' 
    );

    foreach ($names as $name) {
      
      $competence = new Competence();
      $competence->setNom($name); 

      // On la persiste
      $manager->persist($competence);
    }

    // On déclenche l'enregistrement de tous les statuts
    $manager->flush();
  }
}
