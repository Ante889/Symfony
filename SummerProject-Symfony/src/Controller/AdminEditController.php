<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminEditController extends AbstractController
{
    #[Route('/admin/edit', name: 'admin_edit')]
    public function index(): Response
    {
        return $this->render('admin_edit/index.html.twig', [
            'controller_name' => 'AdminEditController',
        ]);
    }
}
