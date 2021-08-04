<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/default/{name}', name: 'default')]
    public function index($name): Response
    {
        return $this-> redirectToRoute('default2');
    }

    #[Route('/default2', name: 'default2')]
    public function index2(): Response
    {
        return new Response('i am from default2 route!');
    }
}


