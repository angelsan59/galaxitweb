<?php

namespace San\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use San\UserBundle\Entity\User;
use San\UserBundle\Form\UserType;
use San\UserBundle\Form\UseraboType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Session\Session;

class UserController extends Controller
{
    public function listAction($page)
    {
   if($page<1){
    throw new NotFoundHttpException('Page "'.$page.'" inexistante.');  
        }
        
    $nbPerPage = 10;
        
    $listUsers = $this->getDoctrine()
      ->getManager()
      ->getRepository('SanUserBundle:User')
      ->getUsers($page, $nbPerPage)
    ;
    
    $nbPages = ceil(count($listUsers) / $nbPerPage);
    if ($page > $nbPages) {
      throw $this->createNotFoundException("La page ".$page." n'existe pas.");
    }
     return $this->render('SanUserBundle:User:listusers.html.twig', array(
      'listUsers' => $listUsers,
      'nbPages'     => $nbPages,
      'page'        => $page,
    ));
    }
    
    public function viewAction($id){
     $em = $this->getDoctrine()->getManager();
     
     $user = $em->getRepository('SanUserBundle:User')->find($id);
     
     if (null === $user){
         throw new NotFoundHttpException("L'utilisateur d'id ".$id." n'existe pas.");
     }
      
    return $this->render('SanUserBundle:User:view.html.twig', array(
      'user' => $user  
    ));
    }
    
    public function addAction(Request $request){
         $user= new User();
        $dateInsc = new \Datetime();
    // On crée le FormBuilder grâce au service form factory
    $form = $this->get('form.factory')->create(UserType::class, $user);

     // Si la requête est en POST
    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

      $user->setDateInsc($dateInsc);
     $user->setEnabled(true);
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        $this->addFlash('notice', 'Utilisateur bien enregistré.');

        return $this->redirectToRoute('san_user_view', array('id' => $user->getId()));
      }

    return $this->render('SanUserBundle:User:add.html.twig', array(
      'form' => $form->createView(),
    ));
    }
    
    public function editAction($id, Request $request)
  {
    $em = $this->getDoctrine()->getManager();
$dateMod = new \Datetime();
    $user = $em->getRepository('SanUserBundle:User')->find($id);

    if (null === $user) {
      throw new NotFoundHttpException("L'utilisateur d'id ".$id." n'existe pas.");
    }

    $form = $this->get('form.factory')->create(UserType::class, $user);

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      // Inutile de persister ici, Doctrine connait déjà notre annonce
   
      $user->setDateMod($dateMod);
      $em->flush();
 
      $this->addFlash('notice', 'Utilisateur bien modifié.');

      return $this->redirectToRoute('san_user_view', array('id' => $user->getId()));
    }

    return $this->render('SanUserBundle:User:edit.html.twig', array(
      'user' => $user,
      'form'   => $form->createView(),
    ));
  }
  
   public function deleteAction(Request $request, $id)
  {
    $em = $this->getDoctrine()->getManager();

    $user = $em->getRepository('SanUserBundle:User')->find($id);

    if (null === $user) {
      throw new NotFoundHttpException("L'utilisateur d'id ".$id." n'existe pas.");
    }

    // On crée un formulaire vide, qui ne contiendra que le champ CSRF
    // Cela permet de protéger la suppression d'annonce contre cette faille
    $form = $this->get('form.factory')->create();

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      $em->remove($user);
      $em->flush();

      $this->addFlash('info', "L'utilisateur a bien été supprimé.");

      return $this->redirectToRoute('san_user_homepage');
    }
    
    return $this->render('SanUserBundle:User:delete.html.twig', array(
      'user' => $user,
      'form'   => $form->createView(),
    ));
  }
  
     public function aboAction(Request $request)
  {
    $em = $this->getDoctrine()->getManager();
$dateMod = new \Datetime();
    $user = $this->getUser();

    if (null === $user) {
      throw new NotFoundHttpException("L'utilisateur n'existe pas.");
    }

    $form = $this->get('form.factory')->create(UseraboType::class, $user);

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      // Inutile de persister ici, Doctrine connait déjà notre annonce
   
      $user->setDateMod($dateMod);
      $em->flush();
 
      $this->addFlash('notice', 'Utilisateur bien modifié.');

      return $this->redirectToRoute('san_newsletter_confirm');
    }

    return $this->render('SanAdminBundle:Newsletter:abonewsletter.html.twig', array(
      'user' => $user,
      'form'   => $form->createView(),
    ));
  }
  
   public function aboconfirmAction()
  {
      return $this->render('SanAdminBundle:Newsletter:aboconfirme.html.twig'); 
   }
   
   public function profilAction()
  {
       $user = $this->getUser();
       $id = $user->getId();
       
     if (null === $user){
         throw new NotFoundHttpException("L'utilisateur n'existe pas.");
     }
      
    return $this->render('SanUserBundle:User:profil.html.twig', array(
      'user' => $user,
      
    ));
   }
   
   public function adminAction($id){
       $em = $this->getDoctrine()->getManager();
$dateMod = new \Datetime();
    $user = $em->getRepository('SanUserBundle:User')->find($id);

    if (null === $user) {
      throw new NotFoundHttpException("L'utilisateur d'id ".$id." n'existe pas.");
    }
$role = array('ROLE_ADMIN');
 
$user->setRoles($role);
   
      $user->setDateMod($dateMod);
      $em->flush();
 
      $this->addFlash('notice', 'Utilisateur bien modifié.');

      return $this->redirectToRoute('san_user_view', array('id' => $user->getId()));
    
   }
}
