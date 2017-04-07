<?php

namespace San\EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class EventController extends Controller
{
    public function indexAction()
    {
        return $this->render('SanEventBundle:Event:index.html.twig');
    }
    
    public function viewAction($id){
        return $this->render('SanEventBundle:Event:view.html.twig', array('id' => $id));
    }
    
    public function addAction(Request $request){
        if ($request->isMethod('POST')){
            $request->getSession()->getFlashBag()->add('notice','Evènement bien enregistré.');
            return $this->redirectToRoute('san_event_view', array('id' => $id));
        }
    }
}
