<?php

namespace San\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use San\CoreBundle\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;

class CoreController extends Controller
{
    public function indexAction()
    {
        return $this->render('SanCoreBundle:Core:index.html.twig');
    }
    
    public function carriereAction()
    {
        return $this->render('SanCoreBundle:Core:carriere.html.twig');
    }
    
     public function conseilAction()
    {
        return $this->render('SanCoreBundle:Core:conseil.html.twig');
    }
    
     public function servicesAction()
    {
        return $this->render('SanCoreBundle:Core:services.html.twig');
    }
     public function solutionsAction()
    {
        return $this->render('SanCoreBundle:Core:solutions.html.twig');
    }
    
    public function legalAction()
    {
        return $this->render('SanCoreBundle:Core:legal.html.twig');
    }
    
    public function vueoffreAction()
    {
        return $this->render('SanCoreBundle:Core:offre.html.twig');
    }
    
    public function sendmailAction()
    {
        $name = 'moi';
        $message = \Swift_Message::newInstance()
        ->setContentType('text/html')
        ->setSubject('Hello Email')
        ->setFrom('send@example.com')
        ->setTo('sandrine@galax-it.com')
        ->setBody(
            $this->renderView(
                'SanCoreBundle:Core:mail.html.twig',
                array('name' => $name)
            )
        )
    ;
    $this->get('mailer')->send($message);

    return $this->render('SanCoreBundle:Core:test.html.twig');
    }
    
     public function contactAction(Request $request)
    {
       $form = $this->get('form.factory')->create(ContactType::class);  
       
       if ($request->isMethod('post') && $form->handleRequest($request)->isValid()) {
         $messagemail = \Swift_Message::newInstance()
        ->setContentType('text/html')
        ->setSubject('GalaxIT - message Contact')
        ->setFrom($form->get('email')->getData())
        ->setTo('sandrine.ociepka@gmail.com')
        ->setBody(
            $this->renderView(
                'SanCoreBundle:Core:mailcontact.html.twig',
                array('nom' => $form->get('nom')->getData(),
                    'prenom' => $form->get('prenom')->getData(),
                    'civilite' => $form->get('civilite')->getData(),
                    'sujet' => $form->get('sujet')->getData(),
                    'message' => $form->get('message')->getData(),
                    'email' => $form->get('email')->getData()
            )
        )
    );
    $this->get('mailer')->send($messagemail);
 $this->addFlash('info', 'Message bien envoyé.');
    return $this->redirectToRoute('san_core_contact');
           
            } 

        return $this->render('SanCoreBundle:Core:contact.html.twig', array(
      'form' => $form->createView(),
    ));
    }
     }
    

