<?php

namespace San\OffresBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * OffreRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class OffreRepository extends \Doctrine\ORM\EntityRepository
{
    public function getOffres($page, $nbPerPage)
  {
     $query = $this->createQueryBuilder('a')
      
      // Jointure sur l'attribut categories
      ->leftJoin('a.categories', 'c')
      ->addSelect('c')
      ->orderBy('a.pubDate', 'DESC')
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
  
  public function getLastOffres()
  {
     $query = $this->createQueryBuilder('a')     
      ->orderBy('a.pubDate', 'DESC')
      ->setMaxResults(10)
      ->getQuery()
    ;
return $query
    
    ->getResult()
  ;
  }
}
