<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminAddController extends AbstractController
{
    #[Route('/admin/add', name: 'admin_add')]
    public function index(): Response
    {
        return $this->render('admin_add/index.html.twig', [
            'controller_name' => 'AdminAddController',
        ]);
    }
}
