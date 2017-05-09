<?php

namespace San\OffresBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use San\NewsBundle\Entity\Categorie;
use San\NewsBundle\Form\CategorieType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
/**
 * Description of CategorieController
 *
 * @author Dev
 */
class CategorieController  extends Controller
{
    public function indexAction($page)
    {
      if($page<1){
    throw new NotFoundHttpException('Page "'.$page.'" inexistante.');  
        }
        
    $nbPerPage = 10;
        
    $listCategories = $this->getDoctrine()
      ->getManager()
      ->getRepository('SanOffresBundle:Categorie')
      ->getCategories($page, $nbPerPage)
    ;
    
    $nbPages = ceil(count($listCategories) / $nbPerPage);
    if ($page > $nbPages) {
      throw $this->createNotFoundException("La page ".$page." n'existe pas.");
    }
     return $this->render('SanOffresBundle:Categorie:index.html.twig', array(
      'listCategories' => $listCategories,
      'nbPages'     => $nbPages,
      'page'        => $page,
    ));
    }
    
     public function addAction(Request $request){
         $categorie= new Categorie();

    // On crée le FormBuilder grâce au service form factory
    $form = $this->get('form.factory')->create(CategorieType::class, $categorie);

     // Si la requête est en POST
    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
   
     
        $em = $this->getDoctrine()->getManager();
        $em->persist($categorie);
        $em->flush();

        $this->addFlash('info', 'Catégorie bien enregistrée.');

        return $this->redirectToRoute('san_categories_homepage');
      }

    return $this->render('SanOffresBundle:Categorie:add.html.twig', array(
      'form' => $form->createView(),
    ));
    }
    
    public function editAction($id, Request $request)
  {
    $em = $this->getDoctrine()->getManager();

    $categorie = $em->getRepository('SanOffresBundle:Categorie')->find($id);

    if (null === $categorie) {
      throw new NotFoundHttpException("La catégorie d'id ".$id." n'existe pas.");
    }

    $form = $this->get('form.factory')->create(CategorieType::class, $categorie);

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      // Inutile de persister ici, Doctrine connait déjà notre annonce
   
      $em->flush();
 
      $this->addFlash('info', 'Catégorie bien modifiée.');

      return $this->redirectToRoute('san_categories_homepage');
    }

    return $this->render('SanOffresBundle:Categorie:edit.html.twig', array(
      'categorie' => $categorie,
      'form'   => $form->createView(),
    ));
  }
  
   public function deleteAction(Request $request, $id)
  {
    $em = $this->getDoctrine()->getManager();

    $categorie = $em->getRepository('SanOffresBundle:Categorie')->find($id);

    if (null === $categorie) {
      throw new NotFoundHttpException("La catégorie d'id ".$id." n'existe pas.");
    }

    // On crée un formulaire vide, qui ne contiendra que le champ CSRF
    // Cela permet de protéger la suppression d'annonce contre cette faille
    $form = $this->get('form.factory')->create();

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      $em->remove($categorie);
      $em->flush();

      $this->addFlash('info', "La catégorie a bien été supprimée.");

      return $this->redirectToRoute('san_categories_homepage');
    }
    
    return $this->render('SanOffresBundle:Categorie:delete.html.twig', array(
      'categorie' => $categorie,
      'form'   => $form->createView(),
    ));
  }
  
}
