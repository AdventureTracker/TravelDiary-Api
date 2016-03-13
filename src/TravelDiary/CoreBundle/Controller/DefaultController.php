<?php

namespace TravelDiary\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('TravelDiaryCoreBundle:Default:index.html.twig');
    }
}
