<?php

namespace San\NewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SanNewsBundle:Default:index.html.twig');
    }
}
