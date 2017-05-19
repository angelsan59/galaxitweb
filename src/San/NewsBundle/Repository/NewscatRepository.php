<?php

namespace San\NewsBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;
/**
 * Description of NewsCatRepository
 *
 * @author Dev
 */
class NewscatRepository extends \Doctrine\ORM\EntityRepository {
    public function getNewscat($page, $nbPerPage)
  {
     $query = $this->createQueryBuilder('a')
      ->orderBy('a.nom')
      ->getQuery()
    ;

     $query
      // On définit l'annonce à partir de laquelle commencer la liste
      ->setFirstResult(($page-1) * $nbPerPage)
      // Ainsi que le nombre d'annonce à afficher sur une page
      ->setMaxResults($nbPerPage)
    ;

    // Enfin, on retourne l'objet Paginator correspondant à la requête construite
    // (n'oubliez pas le use correspondant en début de fichier)
    return new Paginator($query, false);
   
  }
}
