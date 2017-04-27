<?php

namespace San\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CoreController extends Controller
{
    public function indexAction()
    {
        return $this->render('SanCoreBundle:Core:index.html.twig');
    }
    
    public function vueoffreAction()
    {
        return $this->render('SanCoreBundle:Core:offre.html.twig');
    }
    
    public function sendmailAction()
    {
        $name = 'moi';
        $message = \Swift_Message::newInstance()
        ->setSubject('Hello Email')
        ->setFrom('send@example.com')
        ->setTo('sandrine.ociepka@gmail.com')
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
}
