<?php

namespace San\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use San\AdminBundle\Entity\Newsletter;
use San\UserBundle\Entity\User;
use San\AdminBundle\Form\NewsletterType;
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
      ->getNewsletter($page, $nbPerPage)
    ;
    
    $nbPages = ceil(count($listNewsletter) / $nbPerPage);
    if ($page > $nbPages) {
      throw $this->createNotFoundException("La page ".$page." n'existe pas.");
    }
     return $this->render('SanAdminBundle:Newsletter:index.html.twig', array(
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
      
    return $this->render('SanAdminBundle:Newsletter:view.html.twig', array(
      'newsletter' => $newsletter  
    ));
    }
    
     public function addAction(Request $request){
         $newsletter= new Newsletter();

    // On crée le FormBuilder grâce au service form factory
    $form = $this->get('form.factory')->create(NewsletterType::class, $newsletter);

     // Si la requête est en POST
    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
    
        // récupération de la liste des abonnés
        $listAbonnes = $this->getDoctrine()
      ->getManager()
      ->getRepository('SanUserBundle:User')
      ->findByabonewsletter(1); 
        
        // récupération de l'auteur
     $newsletter->setUser($this->getUser());
     
     // enregistrement de la newsletter
        $em = $this->getDoctrine()->getManager();
        $em->persist($newsletter);
        $em->flush();
        
        $this->addFlash('notice', 'Newsletter bien enregistrée.');
        
        // envoi de la newsletter
        foreach($listAbonnes as $abonne)
                     {
                     $aboemail = $abonne->getEmail();
         $message = \Swift_Message::newInstance()
        ->setContentType('text/html')
        ->setSubject($form->get('titre')->getData())
        ->setFrom('send@example.com')
        ->setTo($aboemail)
         ->setBody(
            $this->renderView(
                'SanAdminBundle:Newsletter:mailnewsletter.html.twig',
                array('newsletter' => $newsletter)
            )
        )
    ;
                     $this->get('mailer')->send($message);}
        
        return $this->redirectToRoute('san_newsletter_view', array('id' => $newsletter->getId()));
      }

    return $this->render('SanAdminBundle:Newsletter:add.html.twig', array(
      'form' => $form->createView(),
    ));
    }
    
    public function editAction($id, Request $request)
  {
    $em = $this->getDoctrine()->getManager();

    $newsletter = $em->getRepository('SanAdminBundle:Newsletter')->find($id);

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

    return $this->render('SanAdminBundle:Newsletter:edit.html.twig', array(
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
    
    return $this->render('SanAdminBundle:Newsletter:delete.html.twig', array(
      'newsletter' => $newsletter,
      'form'   => $form->createView(),
    ));
  }
}
