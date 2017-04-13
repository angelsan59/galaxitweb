<?php

namespace San\OffresBundle\Controller;

use San\OffresBundle\Entity\Offre;
use San\OffresBundle\Entity\Contrat;
use San\OffresBundle\Form\OffreType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class OffreController extends Controller
{
    public function indexAction($page)
    {
     
    if($page<1){
    throw new NotFoundHttpException('Page "'.$page.'" inexistante.');  
        }
        
    $nbPerPage = 10;
        
    $listOffres = $this->getDoctrine()
      ->getManager()
      ->getRepository('SanOffresBundle:Offre')
      ->getOffres($page, $nbPerPage)
    ;
    
    $nbPages = ceil(count($listOffres) / $nbPerPage);
    if ($page > $nbPages) {
      throw $this->createNotFoundException("La page ".$page." n'existe pas.");
    }
     return $this->render('SanOffresBundle:Offre:index.html.twig', array(
      'listOffres' => $listOffres,
      'nbPages'     => $nbPages,
      'page'        => $page,
    ));
    }
    
    public function viewAction($id){
        
     $em = $this->getDoctrine()->getManager();
     
     $offre = $em->getRepository('SanOffresBundle:Offre')->find($id);
     
     if (null === $offre){
         throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
     }
      
    return $this->render('SanOffresBundle:Offre:view.html.twig', array(
      'offre' => $offre  
    ));
    }
    
    public function addAction(Request $request)
  {
    // On crée un objet Offre
    $offre = new Offre();

    // On crée le FormBuilder grâce au service form factory
    $form = $this->get('form.factory')->create(OffreType::class, $offre);

     // Si la requête est en POST
    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      $offre->getImage()->upload();
     $offre->setUser($this->getUser());
        $em = $this->getDoctrine()->getManager();
        $em->persist($offre);
        $em->flush();

        $this->addFlash('notice', 'Offre bien enregistrée.');

        return $this->redirectToRoute('san_offre_view', array('id' => $offre->getId()));
      }

    return $this->render('SanOffresBundle:Offre:add.html.twig', array(
      'form' => $form->createView(),
    ));
  }
  
  public function editAction($id, Request $request)
  {
    $em = $this->getDoctrine()->getManager();

    $offre = $em->getRepository('SanOffresBundle:Offre')->find($id);

    if (null === $offre) {
      throw new NotFoundHttpException("L'offre d'id ".$id." n'existe pas.");
    }

    $form = $this->get('form.factory')->create(OffreType::class, $offre);

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      // Inutile de persister ici, Doctrine connait déjà notre annonce
      $em->flush();
 
      $this->addFlash('notice', 'Offre bien modifiée.');

      return $this->redirectToRoute('san_offre_view', array('id' => $offre->getId()));
    }

    return $this->render('SanOffresBundle:Offre:edit.html.twig', array(
      'offre' => $offre,
      'form'   => $form->createView(),
    ));
  }
  
   public function deleteAction(Request $request, $id)
  {
    $em = $this->getDoctrine()->getManager();

    $offre = $em->getRepository('SanOffresBundle:Offre')->find($id);

    if (null === $offre) {
      throw new NotFoundHttpException("L'offre d'id ".$id." n'existe pas.");
    }

    // On crée un formulaire vide, qui ne contiendra que le champ CSRF
    // Cela permet de protéger la suppression d'annonce contre cette faille
    $form = $this->get('form.factory')->create();

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      $em->remove($offre);
      $em->flush();

      $this->addFlash('info', "L'offre a bien été supprimée.");

      return $this->redirectToRoute('san_offre_homepage');
    }
    
    return $this->render('SanOffresBundle:Offre:delete.html.twig', array(
      'offre' => $offre,
      'form'   => $form->createView(),
    ));
  }
}
