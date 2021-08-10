<?php

namespace App\Controller;
use App\Entity\Products;
use App\Form\ProductType;
use App\Repository\ProductsRepository;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    #[Route('/search', name: 'search')]
    public function search(Request $request): Response
    {
        $em=$this->getDoctrine()->getManager();
        $Products= $em -> getRepository(Products::class)->findAll();
        if($request->isMethod("POST")){
            $search = $request->get('search');
            $Products = $em->getRepository(Products::class)->findBy(['title'=>$search]);
        }
        return $this->render('home/search.html.twig', [
            'Products' => $Products
        ]);
    }
}
