<?php

namespace App\Controller;
use App\Entity\Products;
use App\Repository\ProductsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(ProductsRepository $pro): Response
    {
        $Products= $pro->findAll();

        return $this->render('home/index.html.twig', [
            'Products' => $Products
        ]);
    }
}
