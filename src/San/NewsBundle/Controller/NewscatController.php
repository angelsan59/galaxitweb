<?php

namespace San\NewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use San\NewsBundle\Entity\Newscat;
use San\NewsBundle\Form\NewscatType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Session\Session;
/**
 * Description of NewscatController
 *
 * @author Dev
 */
class NewscatController  extends Controller
{
    public function indexAction($page)
    {
      if($page<1){
    throw new NotFoundHttpException('Page "'.$page.'" inexistante.');  
        }
        
    $nbPerPage = 10;
        
    $listNewscat = $this->getDoctrine()
      ->getManager()
      ->getRepository('SanNewsBundle:Newscat')
      ->getNewscat($page, $nbPerPage)
    ;
    
    $nbPages = ceil(count($listNewscat) / $nbPerPage);
    if ($page > $nbPages) {
      throw $this->createNotFoundException("La page ".$page." n'existe pas.");
    }
     return $this->render('SanNewsBundle:Newscat:index.html.twig', array(
      'listNewscat' => $listNewscat,
      'nbPages'     => $nbPages,
      'page'        => $page,
    ));
    }
    
     public function listnewscatAction()
    {
       
    $listNewscat = $this->getDoctrine()
      ->getManager()
      ->getRepository('SanNewsBundle:Newscat')
     ->findby(array(), array('nom' => 'ASC'))
    ;
    
    
     return $this->render('SanNewsBundle:Newscat:listnewscat.html.twig', array(
      'listNewscat' => $listNewscat,
      ));
    }
    
     public function addAction(Request $request){
         $newscat= new Newscat();

    // On crée le FormBuilder grâce au service form factory
    $form = $this->get('form.factory')->create(NewscatType::class, $newscat);

     // Si la requête est en POST
    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
   
     
        $em = $this->getDoctrine()->getManager();
        $em->persist($newscat);
        $em->flush();

        $this->addFlash('info', 'Catégorie bien enregistrée.');

        return $this->redirectToRoute('san_newscat_homepage');
      }

    return $this->render('SanNewsBundle:Newscat:add.html.twig', array(
      'form' => $form->createView(),
    ));
    }
    
    public function editAction($id, Request $request)
  {
    $em = $this->getDoctrine()->getManager();

    $newscat = $em->getRepository('SanNewsBundle:Newscat')->find($id);

    if (null === $newscat) {
      throw new NotFoundHttpException("La catégorie d'id ".$id." n'existe pas.");
    }

    $form = $this->get('form.factory')->create(NewscatType::class, $newscat);

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      // Inutile de persister ici, Doctrine connait déjà notre annonce
   
      $em->flush();
 
      $this->addFlash('info', 'Catégorie bien modifiée.');

      return $this->redirectToRoute('san_newscat_homepage');
    }

    return $this->render('SanNewsBundle:Newscat:edit.html.twig', array(
      'newscat' => $newscat,
      'form'   => $form->createView(),
    ));
  }
  
   public function deleteAction(Request $request, $id)
  {
    $em = $this->getDoctrine()->getManager();

    $newscat = $em->getRepository('SanNewsBundle:Newscat')->find($id);

    if (null === $newscat) {
      throw new NotFoundHttpException("La catégorie d'id ".$id." n'existe pas.");
    }

    // On crée un formulaire vide, qui ne contiendra que le champ CSRF
    // Cela permet de protéger la suppression d'annonce contre cette faille
    $form = $this->get('form.factory')->create();

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      $em->remove($newscat);
      $em->flush();

      $this->addFlash('info', "La catégorie a bien été supprimée.");

      return $this->redirectToRoute('san_newscat_homepage');
    }
    
    return $this->render('SanNewsBundle:Newscat:delete.html.twig', array(
      'newscat' => $newscat,
      'form'   => $form->createView(),
    ));
  }
  
}
