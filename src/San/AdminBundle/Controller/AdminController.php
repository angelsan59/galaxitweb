<?php

namespace San\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function indexAction()
    {
        // Détermination des rendez vous à venir
        $listRdvs = $this->getDoctrine()
      ->getManager()
      ->getRepository('SanUserBundle:User')
      ->getRdvs()
    ;
    
        // Determination nouvelles candidatures
        $statut = $this->getDoctrine()
      ->getManager()
      ->getRepository('SanUserBundle:Statut')
      ->find(19)
    ;
      $listCandidatures = $this->getDoctrine()
      ->getManager()
      ->getRepository('SanOffresBundle:Candidature')
      ->findBy(
              array('statut' => $statut), // Critere
  array('pubdate' => 'desc'));
     
        return $this->render('SanAdminBundle:Admin:index.html.twig', array(
      'listRdvs' => $listRdvs,
      'listCandidatures' => $listCandidatures,
        'statut' => $statut,
    ));
    }
    
    public function faqAction()
    {
        return $this->render('SanAdminBundle:Admin:faq.html.twig');
    }
}
