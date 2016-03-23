<?php

namespace TravelDiary\InterfaceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashboardController extends Controller
{
    public function dashboardAction()
    {
        return $this->render('TravelDiaryInterfaceBundle:Dashboard:dashboard.html.twig', array(
            // ...
        ));
    }

}
