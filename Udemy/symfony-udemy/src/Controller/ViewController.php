<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ViewController extends AbstractController
{
    #[Route('/view', name: 'view')]
    public function index(): Response
    {
        $date = date('l');

        $user=[
            'name' => 'udemy',
            'nachname' => 'dev',
            'alter' => '99'
        ];

        $a= array("hello","world");

        return $this->render('view/index.html.twig', [
            'controller_name' => 'ViewController',
            'SomeName' => $date,
            'object' => $user,
            'a' => $a,
        ]);
    }
}
