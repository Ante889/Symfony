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
    public function index(ProductsRepository $pro, Request $request): Response
    {
        $limit= 6;

        $ProductsForCount= $pro->findAll();
        $Count = ceil(count($ProductsForCount)/$limit);

        $search = "";
        if($request->isMethod("GET")){
            $search = $request->get('page');   
        }
        if(empty($search) || $search ==1){
            $offset = 0; 
        }else{
            $offset = $limit * $search - $limit;
        }

        $Products= $pro-> findBy(array(),array(),$limit,$offset);


        return $this->render('home/index.html.twig', [
            'Products' => $Products,
            'Count' => $Count,
            'Page' => $search
        ]);
    }

    #[Route('/product/{id}', name: 'product')]
    public function product(ProductsRepository $pro,$id): Response
    {
        $product=$this->getDoctrine()->getRepository(Products::class)->find($id);

        return $this->render('home/product.html.twig', [
            'Product' => $product
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
