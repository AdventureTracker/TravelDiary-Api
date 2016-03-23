<?php

namespace TravelDiary\InterfaceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TripController extends Controller
{
    public function overviewAction($page)
    {
        return $this->render('TravelDiaryInterfaceBundle:Trip:overview.html.twig', array(
            // ...
        ));
    }

    public function formAction()
    {
        return $this->render('TravelDiaryInterfaceBundle:Trip:form.html.twig', array(
            // ...
        ));
    }

    public function processAction($id)
    {
        return $this->render('TravelDiaryInterfaceBundle:Trip:process.html.twig', array(
            // ...
        ));
    }

    public function viewAction($id)
    {
        return $this->render('TravelDiaryInterfaceBundle:Trip:view.html.twig', array(
            // ...
        ));
    }

    public function removeAction($id)
    {
        return $this->render('TravelDiaryInterfaceBundle:Trip:remove.html.twig', array(
            // ...
        ));
    }

}
