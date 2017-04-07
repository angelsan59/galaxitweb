<?php

namespace San\OffresBundle\Controller;

use San\OffresBundle\Entity\Offre;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class OffreController extends Controller
{
    public function indexAction($page)
    {
    if($page<1){
    throw new NotFoundHttpException('Page "'.$page.'" inexistante.');  
        }
        
    $nbPerPage = 3;
        
    $listOffres = $this->getDoctrine()
      ->getManager()
      ->getRepository('SanOffresBundle:Offre')
      ->getOffres($page, $nbPerPage)
    ;
    $nbPages = ceil(count($listOffres) / $nbPerPage);
    if ($page > $nbPages) {
      throw $this->createNotFoundException("La page ".$page." n'existe pas.");
    }
     return $this->render('SanOffresBundle:Offre:index.html.twig', array(
      'listOffres' => $listOffres,
      'nbPages'     => $nbPages,
      'page'        => $page,
    ));
    }
    
    public function viewAction($id){
        
     $em = $this->getDoctrine()->getManager();
     
     $offre = $em->getRepository('SanOffresBundle:Offre')->find($id);
     
     if (null === $offre){
         throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
     }

    return $this->render('SanOffresBundle:Offre:view.html.twig', array(
      'offre' => $offre  
    ));
    }
    
    public function addAction(Request $request)
  {
    // On crée un objet Offre
    $offre = new Offre();

    // On crée le FormBuilder grâce au service form factory
    $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $offre);

    // On ajoute les champs de l'entité que l'on veut à notre formulaire
    $formBuilder
      ->add('pubDate',      DateType::class)
      ->add('fin',      DateType::class)
      ->add('titre',     TextType::class)
      ->add('content',   TextareaType::class)
      ->add('mission',   TextareaType::class)
      ->add('formation',   TextareaType::class)
      ->add('auteurid',    TextType::class)
      ->add('published', CheckboxType::class)
      ->add('save',      SubmitType::class)
    ;
    // Pour l'instant, pas de candidatures, catégories, etc., on les gérera plus tard

    // À partir du formBuilder, on génère le formulaire
    $form = $formBuilder->getForm();
    
     // Si la requête est en POST
    if ($request->isMethod('POST')) {
      // On fait le lien Requête <-> Formulaire
      // À partir de maintenant, la variable $advert contient les valeurs entrées dans le formulaire par le visiteur
      $form->handleRequest($request);

      // On vérifie que les valeurs entrées sont correctes
      // (Nous verrons la validation des objets en détail dans le prochain chapitre)
      if ($form->isValid()) {
        // On enregistre notre objet $advert dans la base de données, par exemple
        $em = $this->getDoctrine()->getManager();
        $em->persist($offre);
        $em->flush();

        $request->getSession()->getFlashBag()->add('notice', 'Offre bien enregistrée.');

        // On redirige vers la page de visualisation de l'annonce nouvellement créée
        return $this->redirectToRoute('san_offre_view', array('id' => $offre->getId()));
      }
    }

    // On passe la méthode createView() du formulaire à la vue
    // afin qu'elle puisse afficher le formulaire toute seule
    return $this->render('SanOffresBundle:Offre:add.html.twig', array(
      'form' => $form->createView(),
    ));
  }
}
