<?php

namespace San\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SanAdminBundle:Default:index.html.twig');
    }
}
