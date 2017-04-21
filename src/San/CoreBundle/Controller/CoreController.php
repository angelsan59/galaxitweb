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
}
