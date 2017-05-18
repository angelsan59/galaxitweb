<?php

namespace San\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use San\UserBundle\Entity\Statut;
use San\UserBundle\Form\StatutType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
/**
 * Description of StatutController
 *
 * @author San
 */
class StatutController  extends Controller
{
    public function indexAction($page)
    {
      if($page<1){
    throw new NotFoundHttpException('Page "'.$page.'" inexistante.');  
        }
        
    $nbPerPage = 10;
        
    $listStatuts = $this->getDoctrine()
      ->getManager()
      ->getRepository('SanUserBundle:Statut')
      ->getStatuts($page, $nbPerPage)
    ;
    
    $nbPages = ceil(count($listStatuts) / $nbPerPage);
    if ($page > $nbPages) {
      throw $this->createNotFoundException("La page ".$page." n'existe pas.");
    }
     return $this->render('SanUserBundle:Statut:index.html.twig', array(
      'listStatuts' => $listStatuts,
      'nbPages'     => $nbPages,
      'page'        => $page,
    ));
    }
    
       public function listeAction()
    {
        
    $listStatuts = $this->getDoctrine()
      ->getManager()
      ->getRepository('SanUserBundle:Statut')
      ->findby(array(), array('nom' => 'ASC'))
    ;
    
     return $this->render('SanUserBundle:Statut:listestatuts.html.twig', array(
      'listStatuts' => $listStatuts
    ));
    }
    
     public function addAction(Request $request){
         $statut= new Statut();

    // On crée le FormBuilder grâce au service form factory
    $form = $this->get('form.factory')->create(StatutType::class, $statut);

     // Si la requête est en POST
    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
   
     
        $em = $this->getDoctrine()->getManager();
        $em->persist($statut);
        $em->flush();

        $this->addFlash('info', 'Statut bien enregistré.');

        return $this->redirectToRoute('san_statuts_homepage');
      }

    return $this->render('SanUserBundle:Statut:add.html.twig', array(
      'form' => $form->createView(),
    ));
    }
    
    public function editAction($id, Request $request)
  {
    $em = $this->getDoctrine()->getManager();

    $statut = $em->getRepository('SanUserBundle:Statut')->find($id);

    if (null === $statut) {
      throw new NotFoundHttpException("Le statut d'id ".$id." n'existe pas.");
    }

    $form = $this->get('form.factory')->create(StatutType::class, $statut);

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      // Inutile de persister ici, Doctrine connait déjà notre annonce
   
      $em->flush();
 
      $this->addFlash('info', 'Statut bien modifié.');

      return $this->redirectToRoute('san_statuts_homepage');
    }

    return $this->render('SanUserBundle:Statut:edit.html.twig', array(
      'statut' => $statut,
      'form'   => $form->createView(),
    ));
  }
  
   public function deleteAction(Request $request, $id)
  {
    $em = $this->getDoctrine()->getManager();

    $statut = $em->getRepository('SanUserBundle:Statut')->find($id);

    if (null === $statut) {
      throw new NotFoundHttpException("Le statut d'id ".$id." n'existe pas.");
    }

    // On crée un formulaire vide, qui ne contiendra que le champ CSRF
    // Cela permet de protéger la suppression d'annonce contre cette faille
    $form = $this->get('form.factory')->create();

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      $em->remove($statut);
      $em->flush();

      $this->addFlash('info', "Le statut a bien été supprimé.");

      return $this->redirectToRoute('san_statuts_homepage');
    }
    
    return $this->render('SanUserBundle:Statut:delete.html.twig', array(
      'statut' => $statut,
      'form'   => $form->createView(),
    ));
  }
  
}
