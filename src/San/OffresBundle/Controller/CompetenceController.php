<?php

namespace San\OffresBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use San\NewsBundle\Entity\Competence;
use San\NewsBundle\Form\CompetenceType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
/**
 * Description of CompetenceController
 *
 * @author Dev
 */
class CompetenceController  extends Controller
{
    public function indexAction($page)
    {
      if($page<1){
    throw new NotFoundHttpException('Page "'.$page.'" inexistante.');  
        }
        
    $nbPerPage = 10;
        
    $listCompetences = $this->getDoctrine()
      ->getManager()
      ->getRepository('SanOffresBundle:Competence')
      ->getCompetences($page, $nbPerPage)
    ;
    
    $nbPages = ceil(count($listCompetences) / $nbPerPage);
    if ($page > $nbPages) {
      throw $this->createNotFoundException("La page ".$page." n'existe pas.");
    }
     return $this->render('SanOffresBundle:Competence:index.html.twig', array(
      'listCompetences' => $listCompetences,
      'nbPages'     => $nbPages,
      'page'        => $page,
    ));
    }
    
     public function addAction(Request $request){
         $competence= new Competence();

    // On crée le FormBuilder grâce au service form factory
    $form = $this->get('form.factory')->create(CompetenceType::class, $competence);

     // Si la requête est en POST
    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
   
     
        $em = $this->getDoctrine()->getManager();
        $em->persist($competence);
        $em->flush();

        $this->addFlash('info', 'Compétence bien enregistrée.');

        return $this->redirectToRoute('san_competences_homepage');
      }

    return $this->render('SanOffresBundle:Competence:add.html.twig', array(
      'form' => $form->createView(),
    ));
    }
    
    public function editAction($id, Request $request)
  {
    $em = $this->getDoctrine()->getManager();

    $competence = $em->getRepository('SanOffresBundle:Competence')->find($id);

    if (null === $competence) {
      throw new NotFoundHttpException("La compétence d'id ".$id." n'existe pas.");
    }

    $form = $this->get('form.factory')->create(CompetenceType::class, $competence);

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      // Inutile de persister ici, Doctrine connait déjà notre annonce
   
      $em->flush();
 
      $this->addFlash('info', 'Compétence bien modifiée.');

      return $this->redirectToRoute('san_competences_homepage');
    }

    return $this->render('SanOffresBundle:Competence:edit.html.twig', array(
      'competence' => $competence,
      'form'   => $form->createView(),
    ));
  }
  
   public function deleteAction(Request $request, $id)
  {
    $em = $this->getDoctrine()->getManager();

    $competence = $em->getRepository('SanOffresBundle:Competence')->find($id);

    if (null === $competence) {
      throw new NotFoundHttpException("La competence d'id ".$id." n'existe pas.");
    }

    // On crée un formulaire vide, qui ne contiendra que le champ CSRF
    // Cela permet de protéger la suppression d'annonce contre cette faille
    $form = $this->get('form.factory')->create();

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      $em->remove($competence);
      $em->flush();

      $this->addFlash('info', "La compétence a bien été supprimée.");

      return $this->redirectToRoute('san_competences_homepage');
    }
    
    return $this->render('SanOffresBundle:Competence:delete.html.twig', array(
      'competence' => $competence,
      'form'   => $form->createView(),
    ));
  }
  
}
