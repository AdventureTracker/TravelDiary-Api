<?php

namespace TravelDiary\InterfaceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TripRecordController extends Controller
{
    public function viewAction($trip_id, $record_id)
    {
        return $this->render('TravelDiaryInterfaceBundle:TripRecord:view.html.twig', array(
            // ...
        ));
    }

    public function removeAction($trip_id, $record_id)
    {
        return $this->render('TravelDiaryInterfaceBundle:TripRecord:remove.html.twig', array(
            // ...
        ));
    }

    public function formAction($trip_id, $record_id)
    {
        return $this->render('TravelDiaryInterfaceBundle:TripRecord:form.html.twig', array(
            // ...
        ));
    }

    public function processAction($trip_id, $record_id)
    {
        return $this->render('TravelDiaryInterfaceBundle:TripRecord:process.html.twig', array(
            // ...
        ));
    }

}
