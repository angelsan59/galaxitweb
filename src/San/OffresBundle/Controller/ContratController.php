<?php

namespace San\OffresBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use San\OffresBundle\Entity\Contrat;
use San\OffresBundle\Form\ContratType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
/**
 * Description of ContratController
 *
 * @author Dev
 */
class ContratController  extends Controller
{
    public function indexAction($page)
    {
      if($page<1){
    throw new NotFoundHttpException('Page "'.$page.'" inexistante.');  
        }
        
    $nbPerPage = 10;
        
    $listContrats = $this->getDoctrine()
      ->getManager()
      ->getRepository('SanOffresBundle:Contrat')
      ->getContrats($page, $nbPerPage)
    ;
    
    $nbPages = ceil(count($listContrats) / $nbPerPage);
    if ($page > $nbPages) {
      throw $this->createNotFoundException("La page ".$page." n'existe pas.");
    }
     return $this->render('SanOffresBundle:Contrat:index.html.twig', array(
      'listContrats' => $listContrats,
      'nbPages'     => $nbPages,
      'page'        => $page,
    ));
    }
    
     public function addAction(Request $request){
         $contrat= new Contrat();

    // On crée le FormBuilder grâce au service form factory
    $form = $this->get('form.factory')->create(ContratType::class, $contrat);

     // Si la requête est en POST
    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
   
     
        $em = $this->getDoctrine()->getManager();
        $em->persist($contrat);
        $em->flush();

        $this->addFlash('info', 'Contrat bien enregistré.');

        return $this->redirectToRoute('san_contrats_homepage');
      }

    return $this->render('SanOffresBundle:Contrat:add.html.twig', array(
      'form' => $form->createView(),
    ));
    }
    
    public function editAction($id, Request $request)
  {
    $em = $this->getDoctrine()->getManager();

    $contrat = $em->getRepository('SanOffresBundle:Contrat')->find($id);

    if (null === $contrat) {
      throw new NotFoundHttpException("Le contrat d'id ".$id." n'existe pas.");
    }

    $form = $this->get('form.factory')->create(ContratType::class, $contrat);

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      // Inutile de persister ici, Doctrine connait déjà notre annonce
   
      $em->flush();
 
      $this->addFlash('info', 'Contrat bien modifié.');

      return $this->redirectToRoute('san_contrats_homepage');
    }

    return $this->render('SanOffresBundle:Contrat:edit.html.twig', array(
      'contrat' => $contrat,
      'form'   => $form->createView(),
    ));
  }
  
   public function deleteAction(Request $request, $id)
  {
    $em = $this->getDoctrine()->getManager();

    $contrat = $em->getRepository('SanOffresBundle:Contrat')->find($id);

    if (null === $contrat) {
      throw new NotFoundHttpException("Le contrat d'id ".$id." n'existe pas.");
    }

    // On crée un formulaire vide, qui ne contiendra que le champ CSRF
    // Cela permet de protéger la suppression d'annonce contre cette faille
    $form = $this->get('form.factory')->create();

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      $em->remove($contrat);
      $em->flush();

      $this->addFlash('info', "Le contrat a bien été supprimé.");

      return $this->redirectToRoute('san_contrats_homepage');
    }
    
    return $this->render('SanOffresBundle:Contrat:delete.html.twig', array(
      'contrat' => $contrat,
      'form'   => $form->createView(),
    ));
  }
  
}
