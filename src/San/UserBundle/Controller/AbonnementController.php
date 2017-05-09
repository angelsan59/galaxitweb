<?php

namespace San\UserBundle\Controller;

use San\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
/**
 * Description of AbonnementController
 *
 * @author Dev
 */
class AbonnementController extends Controller {
   public function indexAction($page)
    {
       if($page<1){
    throw new NotFoundHttpException('Page "'.$page.'" inexistante.');  
        }
        
    $nbPerPage = 10;
        
    $listAbonnes = $this->getDoctrine()
      ->getManager()
      ->getRepository('SanUserBundle:User')
      ->getAbonnes($page, $nbPerPage)
    ;
    
    $nbPages = ceil(count($listAbonnes) / $nbPerPage);
    if ($page > $nbPages) {
      throw $this->createNotFoundException("La page ".$page." n'existe pas.");
    }
     return $this->render('SanUserBundle:User:listabonnes.html.twig', array(
      'listAbonnes' => $listAbonnes,
      'nbPages'     => $nbPages,
      'page'        => $page,
    ));
   }
}
