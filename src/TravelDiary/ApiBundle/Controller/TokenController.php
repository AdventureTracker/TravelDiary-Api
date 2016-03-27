<?php

namespace TravelDiary\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class TokenController extends Controller
{
    public function deleteAction()
    {
        return new JsonResponse(null, Response::HTTP_NOT_IMPLEMENTED);
    }

    public function createAction()
    {
        return new JsonResponse(null, Response::HTTP_NOT_IMPLEMENTED);
    }

}
