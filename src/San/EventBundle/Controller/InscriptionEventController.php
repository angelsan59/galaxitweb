<?php

namespace San\EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use San\EventBundle\Entity\Inscription;
use San\EventBundle\Entity\Event;
use San\UserBundle\Entity\User;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\FOSUserEvents;
use San\EventBundle\Form\InscriptionType;
use San\EventBundle\Form\InscriptionlogType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Security;

class InscriptionEventController extends Controller {
   
     public function indexAction($page)
    {
    if($page<1){
    throw new NotFoundHttpException('Page "'.$page.'" inexistante.');  
        }
        
    $nbPerPage = 10;
        
    $listInscriptions = $this->getDoctrine()
      ->getManager()
      ->getRepository('SanEventBundle:Inscription')
      ->getInscriptions($page, $nbPerPage)
    ;
    
    $nbPages = ceil(count($listInscriptions) / $nbPerPage);
    if ($page > $nbPages) {
      throw $this->createNotFoundException("La page ".$page." n'existe pas.");
    }
     return $this->render('SanEventBundle:Event:inscindex.html.twig', array(
      'listInscriptions' => $listInscriptions,
      'nbPages'     => $nbPages,
      'page'        => $page,
    ));
    }
    
    public function viewAction($id){
     $em = $this->getDoctrine()->getManager();
     
     $inscription = $em->getRepository('SanEventBundle:Inscription')->getInsc($id);
     
     if (null === $inscription){
         throw new NotFoundHttpException("L'inscription d'id ".$id." n'existe pas.");
     }
      
    return $this->render('SanEventBundle:Event:inscview.html.twig', array(
      'inscription' => $inscription  
    ));
    }
    
    public function addAction($id, Request $request){
        $em = $this->getDoctrine()->getManager();
     
     $event = $em->getRepository('SanEventBundle:Event')->find($id);
    
     if (null === $event){
         throw new NotFoundHttpException("L'évènement d'id ".$id." n'existe pas.");
     } 
        
        $inscription= new Inscription();
        
    $form = $this->get('form.factory')->create(InscriptionlogType::class, $inscription);

     // Si la requête est en POST
    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
    
        $inscription->setUser($this->getUser());
      $inscription->setEvent($event);
        $em = $this->getDoctrine()->getManager();
        $em->persist($inscription);
        $em->flush();

        $this->addFlash('notice', 'Inscription bien enregistrée.');

        return $this->redirectToRoute('san_insc_view', array('id' => $inscription->getId(), 'event' => $event,));
      }

    return $this->render('SanEventBundle:Event:inscadd.html.twig', array(
      'form' => $form->createView(),
        'event' => $event,
       
    ));
    }
    
    public function addpubAction($id, Request $request){
        $em = $this->getDoctrine()->getManager();
     
     $event = $em->getRepository('SanEventBundle:Event')->find($id);
    
     if (null === $event){
         throw new NotFoundHttpException("L'évènement d'id ".$id." n'existe pas.");
     } 
     
        $session = $request->getSession();
      $session->set('event_id', $id);
       return $this->render('SanEventBundle:Event:inscaddpub.html.twig', array(
      'event' => $event 
    ));
    }
    public function addpub1Action($id, Request $request){
      
    /** 1. Login in user **/
        
        /** @var $session \Symfony\Component\HttpFoundation\Session\Session */
        $session = $request->getSession();

        $authErrorKey = Security::AUTHENTICATION_ERROR;
        $lastUsernameKey = Security::LAST_USERNAME;

        // get the error if any (works with forward and redirect -- see below)
        if ($request->attributes->has($authErrorKey)) {
            $error = $request->attributes->get($authErrorKey);
        } elseif (null !== $session && $session->has($authErrorKey)) {
            $error = $session->get($authErrorKey);
            $session->remove($authErrorKey);
        } else {
            $error = null;
        }

        if (!$error instanceof AuthenticationException) {
            $error = null; // The value does not come from the security component.
        }

        // last username entered by the user
        $lastUsername = (null === $session) ? '' : $session->get($lastUsernameKey);

        $csrfToken = $this->has('security.csrf.token_manager')
            ? $this->get('security.csrf.token_manager')->getToken('authenticate')->getValue()
            : null;

        return $this->render('@FOSUser/Security/login.html.twig', array(
            'last_username' => $lastUsername,
            'error' => $error,
            'csrf_token' => $csrfToken,
        ));
        
        
        
           
    }
    public function editAction($id, Request $request)
  {
    $em = $this->getDoctrine()->getManager();

    $inscription = $em->getRepository('SanEventBundle:Inscription')->find($id);

    if (null === $inscription) {
      throw new NotFoundHttpException("L'inscription d'id ".$id." n'existe pas.");
    }

    $form = $this->get('form.factory')->create(EventType::class, $inscription);

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      // Inutile de persister ici, Doctrine connait déjà notre annonce
      
       $em->flush();
 
      $this->addFlash('notice', 'Inscription bien modifiée.');

      return $this->redirectToRoute('san_insc_view', array('id' => $inscription->getId()));
    }

    return $this->render('SanEventBundle:Event:inscedit.html.twig', array(
      'inscription' => $inscription,
      'form'   => $form->createView(),
    ));
  }
  
   public function deleteAction(Request $request, $id)
  {
    $em = $this->getDoctrine()->getManager();

    $inscription = $em->getRepository('SanEventBundle:Inscription')->find($id);

    if (null === $inscription) {
      throw new NotFoundHttpException("L'inscription d'id ".$id." n'existe pas.");
    }

    // On crée un formulaire vide, qui ne contiendra que le champ CSRF
    // Cela permet de protéger la suppression d'annonce contre cette faille
    $form = $this->get('form.factory')->create();

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      $em->remove($inscription);
      $em->flush();

      $this->addFlash('info', "L'inscription a bien été supprimée.");

      return $this->redirectToRoute('san_insc_homepage');
    }
    
    return $this->render('SanEventBundle:Event:inscdelete.html.twig', array(
      'inscription' => $inscription,
      'form'   => $form->createView(),
    ));
  }
}
