<?php

namespace San\OffresBundle\Controller;

use San\OffresBundle\Entity\Candidature;
use San\OffresBundle\Entity\Offre;
use San\UserBundle\Entity\Statut;
use San\OffresBundle\Form\CandidatureType;
use San\OffresBundle\Form\StatutcandType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Dompdf\Options;
use Dompdf\Dompdf;
/**
 * Description of CandidatureController
 *
 * @author Dev
 */
class CandidatureController extends Controller {
    
    public function indexAction($page)
    {
    if($page<1){
    throw new NotFoundHttpException('Page "'.$page.'" inexistante.');  
        }
        
    $nbPerPage = 10;
        
    $listCandidatures = $this->getDoctrine()
      ->getManager()
      ->getRepository('SanOffresBundle:Candidature')
      ->getCandidatures($page, $nbPerPage)
    ;
    
    $nbPages = ceil(count($listCandidatures) / $nbPerPage);
    if ($page > $nbPages) {
      throw $this->createNotFoundException("La page ".$page." n'existe pas.");
    }
     return $this->render('SanOffresBundle:Candidature:index.html.twig', array(
      'listCandidatures' => $listCandidatures,
      'nbPages'     => $nbPages,
      'page'        => $page,
    ));
    }
    
    public function viewAction($id){
     $em = $this->getDoctrine()->getManager();
     
     $candidature = $em->getRepository('SanOffresBundle:Candidature')->find($id);
     
     if (null === $candidature){
         throw new NotFoundHttpException("La candidature d'id ".$id." n'existe pas.");
     }
      
    return $this->render('SanOffresBundle:Candidature:view.html.twig', array(
      'candidature' => $candidature  
    ));
    }
    
    public function succesAction($id){
     $em = $this->getDoctrine()->getManager();
     
     $candidature = $em->getRepository('SanOffresBundle:Candidature')->find($id);
     
     if (null === $candidature){
         throw new NotFoundHttpException("La candidature d'id ".$id." n'existe pas.");
     }
      
    return $this->render('SanOffresBundle:Candidature:succes.html.twig', array(
      'candidature' => $candidature  
    ));
    }
    
    public function addAction($id, Request $request){
        $em = $this->getDoctrine()->getManager();
     
     $offre = $em->getRepository('SanOffresBundle:Offre')->find($id);
    $statut = $em->getRepository('SanUserBundle:Statut')->find('19'); 
     if (null === $offre){
         throw new NotFoundHttpException("L'offre d'id ".$id." n'existe pas.");
     } 
        
        $candidature= new Candidature();
        
    $form = $this->get('form.factory')->create(CandidatureType::class, $candidature);

     // Si la requête est en POST
    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
    
        $candidature->setUser($this->getUser());
      $candidature->setOffre($offre);
      $candidature->setStatut($statut);
        $em = $this->getDoctrine()->getManager();
        $em->persist($candidature);
        $em->flush();

        $this->addFlash('notice', 'Candidature bien enregistrée.');

        return $this->redirectToRoute('san_candidature_succes', array('id' => $candidature->getId(), 'offre' => $offre,));
      }

    return $this->render('SanOffresBundle:Candidature:add.html.twig', array(
      'form' => $form->createView(),
        'offre' => $offre,
       
    ));
    }
    
    public function editAction($id, Request $request)
  {
    $em = $this->getDoctrine()->getManager();

    $candidature = $em->getRepository('SanOffresBundle:Candidature')->find($id);

    if (null === $candidature) {
      throw new NotFoundHttpException("La candidature d'id ".$id." n'existe pas.");
    }

    $form = $this->get('form.factory')->create(CandidatureType::class, $candidature);

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      // Inutile de persister ici, Doctrine connait déjà notre annonce
      
       $em->flush();
 
      $this->addFlash('notice', 'Candidature bien modifiée.');

      return $this->redirectToRoute('san_candidature_view', array('id' => $candidature->getId()));
    }

    return $this->render('SanOffresBundle:Candidature:edit.html.twig', array(
      'candidature' => $candidature,
      'form'   => $form->createView(),
    ));
  }
  
   public function deleteAction(Request $request, $id)
  {
    $em = $this->getDoctrine()->getManager();

    $candidature = $em->getRepository('SanOffresBundle:Candidature')->find($id);

    if (null === $candidature) {
      throw new NotFoundHttpException("La candidature d'id ".$id." n'existe pas.");
    }

    // On crée un formulaire vide, qui ne contiendra que le champ CSRF
    // Cela permet de protéger la suppression d'annonce contre cette faille
    $form = $this->get('form.factory')->create();

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      $em->remove($candidature);
      $em->flush();

      $this->addFlash('info', "La candidature a bien été supprimée.");

      return $this->redirectToRoute('san_candidature_homepage');
    }
    
    return $this->render('SanOffresBundle:Candidature:delete.html.twig', array(
      'candidature' => $candidature,
      'form'   => $form->createView(),
    ));
  }
  
  public function statutlistAction($id){
    
      $statut = $this->getDoctrine()
      ->getManager()
      ->getRepository('SanUserBundle:Statut')
      ->find($id)
    ;
      $listCandidatures = $this->getDoctrine()
      ->getManager()
      ->getRepository('SanOffresBundle:Candidature')
      ->findByStatut($id)
    ;
      
     
     if (null === $listCandidatures){
         throw new NotFoundHttpException("La candidature d'id ".$id." n'existe pas.");
     }
      
    return $this->render('SanOffresBundle:Candidature:statutlist.html.twig', array(
      'listCandidatures' => $listCandidatures,
        'statut' => $statut,
    ));
    }
    
    public function adminviewAction($id, Request $request){
     $em = $this->getDoctrine()->getManager();
     
     $candidature = $em->getRepository('SanOffresBundle:Candidature')->find($id);
     
     if (null === $candidature){
         throw new NotFoundHttpException("La candidature d'id ".$id." n'existe pas.");
     }
     
    $form = $this->get('form.factory')->create(StatutcandType::class, $candidature);

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      // Inutile de persister ici, Doctrine connait déjà notre annonce
      
       $em->flush();
 
      $this->addFlash('notice', 'Candidature bien modifiée.');

      return $this->redirectToRoute('san_candidature_succes', array('id' => $candidature->getId()));
    } 
      
    return $this->render('SanOffresBundle:Candidature:adminview.html.twig', array(
      'candidature' => $candidature,
         'form'   => $form->createView(),
    ));
    }
    
    public function toPdfAction($id) {
    // On récupère l'objet à afficher (rien d'inconnu jusque là)
    $objectsRepository = $this->getDoctrine()->getRepository('SanOffresBundle:Candidature');
    $candidature = $objectsRepository->findOneById($id);        
    // On crée une  instance pour définir les options de notre fichier pdf
    $options = new Options();
    // Pour simplifier l'affichage des images, on autorise dompdf à utiliser 
    // des  url pour les nom de  fichier
    $options->set('isRemoteEnabled', TRUE);
    // On crée une instance de dompdf avec  les options définies
    $dompdf = new Dompdf($options);
    // On demande à Symfony de générer  le code html  correspondant à 
    // notre template, et on stocke ce code dans une variable
    $html = $this->renderView(
      'SanOffresBundle:Candidature:pdfTemplate.html.twig', 
      array('candidature' => $candidature)
    );
    // On envoie le code html  à notre instance de dompdf
    $dompdf->loadHtml($html);        
    // On demande à dompdf de générer le  pdf
    $dompdf->render();
    // On renvoie  le flux du fichier pdf dans une  Response pour l'utilisateur
    return new Response ($dompdf->stream());
}

}
