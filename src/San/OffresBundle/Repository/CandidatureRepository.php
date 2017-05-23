<?php

namespace San\OffresBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;
/**
 * CandidatureRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CandidatureRepository extends \Doctrine\ORM\EntityRepository
{
     public function getCandidatures($page, $nbPerPage)
  {
     $query = $this->createQueryBuilder('a')
      
      ->orderBy('a.pubdate', 'DESC')
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
  
   public function getCvthequeAll($page, $nbPerPage)
  {
     $query = $this->createQueryBuilder('a')
     
    ->leftJoin('a.statut', 'st', 'WITH', 'st.cvtheque=1')
          
    ->addSelect('st')
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
  
  public function candProfil($id)
{
   $qb = $this
    ->createQueryBuilder('a')
    ->leftJoin('a.user', 'user', 'WITH', 'user.id=:id')
           ->setParameter('id', $id)
    ->addSelect('user')
  ;

  return $qb
    ->getQuery()
    ->getResult()
  ;
}

}
