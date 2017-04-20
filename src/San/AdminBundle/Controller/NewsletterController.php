<?php

namespace San\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use San\NewsBundle\Entity\News;
use San\NewsBundle\Form\NewsType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Session\Session;

class NewsletterController extends Controller
{
    public function indexAction($page)
    {
      if($page<1){
    throw new NotFoundHttpException('Page "'.$page.'" inexistante.');  
        }
        
    $nbPerPage = 10;
        
    $listNewsletter = $this->getDoctrine()
      ->getManager()
      ->getRepository('SanAdminBundle:Newsletter')
      ->getNews($page, $nbPerPage)
    ;
    
    $nbPages = ceil(count($listNewsletter) / $nbPerPage);
    if ($page > $nbPages) {
      throw $this->createNotFoundException("La page ".$page." n'existe pas.");
    }
     return $this->render('SanAdminBundle:Admin:newsletterlist.html.twig', array(
      'listNewsletter' => $listNewsletter,
      'nbPages'     => $nbPages,
      'page'        => $page,
    ));
    }
    
    public function viewAction($id){
     $em = $this->getDoctrine()->getManager();
     
     $newsletter = $em->getRepository('SanAdminBundle:Newsletter')->find($id);
     
     if (null === $newsletter){
         throw new NotFoundHttpException("La newsletter d'id ".$id." n'existe pas.");
     }
      
    return $this->render('SanAdminBundle:Admin:newsletterview.html.twig', array(
      'newsletter' => $newsletter  
    ));
    }
    
     public function addAction(Request $request){
         $newsletter= new Newsletter();

    // On crée le FormBuilder grâce au service form factory
    $form = $this->get('form.factory')->create(NewsletterType::class, $newsletter);

     // Si la requête est en POST
    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      $newsletter->getImage()->upload();
     $newsletter->setUser($this->getUser());
        $em = $this->getDoctrine()->getManager();
        $em->persist($newsletter);
        $em->flush();

        $this->addFlash('notice', 'Newsletter bien enregistrée.');

        return $this->redirectToRoute('san_newsletter_view', array('id' => $newsletter->getId()));
      }

    return $this->render('SanAdminBundle:Admin:newsletteradd.html.twig', array(
      'form' => $form->createView(),
    ));
    }
    
    public function editAction($id, Request $request)
  {
    $em = $this->getDoctrine()->getManager();

    $newsletter = $em->getRepository('SanAdminBundle:News')->find($id);

    if (null === $newsletter) {
      throw new NotFoundHttpException("La newsletter d'id ".$id." n'existe pas.");
    }

    $form = $this->get('form.factory')->create(NewsletterType::class, $newsletter);

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      // Inutile de persister ici, Doctrine connait déjà notre annonce
      $em->flush();
 
      $this->addFlash('notice', 'Newsletter bien modifiée.');

      return $this->redirectToRoute('san_newsletter_view', array('id' => $newsletter->getId()));
    }

    return $this->render('SanAdminBundle:Admin:newsletteredit.html.twig', array(
      'newsletter' => $newsletter,
      'form'   => $form->createView(),
    ));
  }
  
   public function deleteAction(Request $request, $id)
  {
    $em = $this->getDoctrine()->getManager();

    $newsletter = $em->getRepository('SanAdminBundle:Newsletter')->find($id);

    if (null === $newsletter) {
      throw new NotFoundHttpException("La newsletter d'id ".$id." n'existe pas.");
    }

    // On crée un formulaire vide, qui ne contiendra que le champ CSRF
    // Cela permet de protéger la suppression d'annonce contre cette faille
    $form = $this->get('form.factory')->create();

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      $em->remove($newsletter);
      $em->flush();

      $this->addFlash('info', "La newsletter a bien été supprimée.");

      return $this->redirectToRoute('san_newsletter_homepage');
    }
    
    return $this->render('SanAdminBundle:Admin:newsletterdelete.html.twig', array(
      'newsletter' => $newsletter,
      'form'   => $form->createView(),
    ));
  }
}
