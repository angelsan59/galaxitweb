<?php

namespace San\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function indexAction()
    {
        return $this->render('SanAdminBundle:Admin:index.html.twig');
    }
}
