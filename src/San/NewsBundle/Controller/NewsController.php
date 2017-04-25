<?php

namespace San\NewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use San\NewsBundle\Entity\News;
use San\NewsBundle\Form\NewsType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Session\Session;

class NewsController extends Controller
{
    public function indexAction($page)
    {
      if($page<1){
    throw new NotFoundHttpException('Page "'.$page.'" inexistante.');  
        }
        
    $nbPerPage = 10;
        
    $listNews = $this->getDoctrine()
      ->getManager()
      ->getRepository('SanNewsBundle:News')
      ->getNews($page, $nbPerPage)
    ;
    
    $nbPages = ceil(count($listNews) / $nbPerPage);
    if ($page > $nbPages) {
      throw $this->createNotFoundException("La page ".$page." n'existe pas.");
    }
     return $this->render('SanNewsBundle:News:index.html.twig', array(
      'listNews' => $listNews,
      'nbPages'     => $nbPages,
      'page'        => $page,
    ));
    }
    
    public function viewAction($id){
     $em = $this->getDoctrine()->getManager();
     
     $news = $em->getRepository('SanNewsBundle:News')->find($id);
     
     if (null === $news){
         throw new NotFoundHttpException("La news d'id ".$id." n'existe pas.");
     }
      
    return $this->render('SanNewsBundle:News:view.html.twig', array(
      'news' => $news  
    ));
    }
    
     public function addAction(Request $request){
         $news= new News();

    // On crée le FormBuilder grâce au service form factory
    $form = $this->get('form.factory')->create(NewsType::class, $news);

     // Si la requête est en POST
    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
   
     $news->setUser($this->getUser());
        $em = $this->getDoctrine()->getManager();
        $em->persist($news);
        $em->flush();

        $this->addFlash('notice', 'News bien enregistrée.');

        return $this->redirectToRoute('san_news_view', array('id' => $news->getId()));
      }

    return $this->render('SanNewsBundle:News:add.html.twig', array(
      'form' => $form->createView(),
    ));
    }
    
    public function editAction($id, Request $request)
  {
    $em = $this->getDoctrine()->getManager();

    $news = $em->getRepository('SanNewsBundle:News')->find($id);

    if (null === $news) {
      throw new NotFoundHttpException("La news d'id ".$id." n'existe pas.");
    }

    $form = $this->get('form.factory')->create(NewsType::class, $news);

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      // Inutile de persister ici, Doctrine connait déjà notre annonce
   
      $em->flush();
 
      $this->addFlash('notice', 'News bien modifiée.');

      return $this->redirectToRoute('san_news_view', array('id' => $news->getId()));
    }

    return $this->render('SanNewsBundle:News:edit.html.twig', array(
      'news' => $news,
      'form'   => $form->createView(),
    ));
  }
  
   public function deleteAction(Request $request, $id)
  {
    $em = $this->getDoctrine()->getManager();

    $news = $em->getRepository('SanNewsBundle:News')->find($id);

    if (null === $news) {
      throw new NotFoundHttpException("La news d'id ".$id." n'existe pas.");
    }

    // On crée un formulaire vide, qui ne contiendra que le champ CSRF
    // Cela permet de protéger la suppression d'annonce contre cette faille
    $form = $this->get('form.factory')->create();

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      $em->remove($news);
      $em->flush();

      $this->addFlash('info', "La news a bien été supprimée.");

      return $this->redirectToRoute('san_news_homepage');
    }
    
    return $this->render('SanNewsBundle:News:delete.html.twig', array(
      'news' => $news,
      'form'   => $form->createView(),
    ));
  }
}
