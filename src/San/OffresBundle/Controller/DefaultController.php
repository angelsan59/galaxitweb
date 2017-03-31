<?php

namespace San\OffresBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SanOffresBundle:Default:index.html.twig');
    }
}
