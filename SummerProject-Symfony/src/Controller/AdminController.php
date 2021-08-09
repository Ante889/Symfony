<?php

namespace App\Controller;

use App\Entity\Products;
use App\Repository\ProductsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'admin')]
    public function index(ProductsRepository $pro): Response
    {
        $Products= $pro->findAll();

        return $this->render('admin/index.html.twig', [
            'Products' => $Products
        ]);
    }
}
