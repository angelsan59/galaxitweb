<?php

namespace San\EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use San\EventBundle\Entity\Event;
use San\EventBundle\Form\EventType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Session\Session;

class EventController extends Controller
{
    public function indexAction($page)
    {
    if($page<1){
    throw new NotFoundHttpException('Page "'.$page.'" inexistante.');  
        }
        
    $nbPerPage = 10;
        
    $listEvents = $this->getDoctrine()
      ->getManager()
      ->getRepository('SanEventBundle:Event')
      ->getEvents($page, $nbPerPage)
    ;
    
    $nbPages = ceil(count($listEvents) / $nbPerPage);
    if ($page > $nbPages) {
      throw $this->createNotFoundException("La page ".$page." n'existe pas.");
    }
     return $this->render('SanEventBundle:Event:index.html.twig', array(
      'listEvents' => $listEvents,
      'nbPages'     => $nbPages,
      'page'        => $page,
    ));
    }
    
    public function viewAction($id){
     $em = $this->getDoctrine()->getManager();
     
     $event = $em->getRepository('SanEventBundle:Event')->find($id);
     
     if (null === $event){
         throw new NotFoundHttpException("L'évènement d'id ".$id." n'existe pas.");
     }
      
    return $this->render('SanEventBundle:Event:view.html.twig', array(
      'event' => $event  
    ));
    }
    
    public function addAction(Request $request){
         $event= new Event();

    // On crée le FormBuilder grâce au service form factory
    $form = $this->get('form.factory')->create(EventType::class, $event);

     // Si la requête est en POST
    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      $event->getImage()->upload();
     $event->setUser($this->getUser());
        $em = $this->getDoctrine()->getManager();
        $em->persist($event);
        $em->flush();

        $this->addFlash('notice', 'Evènement bien enregistré.');

        return $this->redirectToRoute('san_event_view', array('id' => $event->getId()));
      }

    return $this->render('SanEventBundle:Event:add.html.twig', array(
      'form' => $form->createView(),
    ));
    }
    
    public function editAction($id, Request $request)
  {
    $em = $this->getDoctrine()->getManager();

    $event = $em->getRepository('SanEventBundle:Event')->find($id);

    if (null === $event) {
      throw new NotFoundHttpException("L'évènement d'id ".$id." n'existe pas.");
    }

    $form = $this->get('form.factory')->create(EventType::class, $event);

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      // Inutile de persister ici, Doctrine connait déjà notre annonce
      $em->flush();
 
      $this->addFlash('notice', 'Evènement bien modifié.');

      return $this->redirectToRoute('san_event_view', array('id' => $event->getId()));
    }

    return $this->render('SanEventBundle:Event:edit.html.twig', array(
      'event' => $event,
      'form'   => $form->createView(),
    ));
  }
  
   public function deleteAction(Request $request, $id)
  {
    $em = $this->getDoctrine()->getManager();

    $event = $em->getRepository('SanEventBundle:Event')->find($id);

    if (null === $event) {
      throw new NotFoundHttpException("L'évènement d'id ".$id." n'existe pas.");
    }

    // On crée un formulaire vide, qui ne contiendra que le champ CSRF
    // Cela permet de protéger la suppression d'annonce contre cette faille
    $form = $this->get('form.factory')->create();

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      $em->remove($event);
      $em->flush();

      $this->addFlash('info', "L'évènement a bien été supprimé.");

      return $this->redirectToRoute('san_event_homepage');
    }
    
    return $this->render('SanEventBundle:Event:delete.html.twig', array(
      'event' => event,
      'form'   => $form->createView(),
    ));
  }
}
