<?php

namespace App\Controller;

use App\Entity\Products;
use App\Repository\ProductsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

    #[Route('/product', name: 'product.')]
class ProductController extends AbstractController
{
    #[Route('/', name: 'edit')]
    public function index(ProductsRepository $pro): Response
    {
        $Products= $pro->findAll();

        return $this->render('home/index.html.twig', [
            'Products' => $Products
        ]);
    }
    #[Route('/create', name: 'create')]
    public function Create(Request $request){
        $Products = new Products();
        $Products->setTitle('NoviProdukt');
        $Products->setAuthor('Vinko');
        $Products->setImage('NewImage');
        $Products->setPrice(1.99);
        $Products->setCategory(1);
        $Products->setQuantity(2);
        $Products->setContent('gawwagwagwagwagw');
        //EntityMenager
        $em=$this->getDoctrine()->getManager();
        $em->persist($Products);
        $em->flush();
        //Respone
        return new Response("Created");
    }
}
