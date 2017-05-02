<?php

namespace San\UserBundle\Controller;

use San\UserBundle\Entity\User;
use San\UserBundle\Form\AbonnementType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
/**
 * Description of AbonnementController
 *
 * @author Dev
 */
class AbonnementController extends \Symfony\Component\HttpKernel\Tests\Controller {
   public function indexAction($page)
    {
       
   }
   
    public function aboAction(Request $request){
      $em = $this->getDoctrine()->getManager();

    $abonnement = getUser();

    if (null === $abonnement) {
      throw new NotFoundHttpException("L'abonnement d'id ".$id." n'existe pas.");
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
}
