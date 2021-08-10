<?php

namespace App\Controller;

use App\Entity\Products;
use App\Form\ProductType;
use App\Form\ProductUpdateType;
use App\Repository\ProductsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/create', name: 'create')]
    public function Create(Request $request){
        $Products = new Products();
        $Form = $this->createForm(ProductType::class,$Products);
        $Form->handleRequest($request);
        
        if ($Form->isSubmitted() && $Form->isValid()) { 
            $em=$this->getDoctrine()->getManager();
            $em->persist($Products);
            $em->flush();
            $this->addFlash('success','Product Created!');
            return $this->redirect($request->getUri());
        }
        
        //Respone
        return $this->render('admin/create.html.twig', [
            'CreateForm' => $Form->createView(),
        ]);
    }
    #[Route('/delete/{id}', name: 'delete')]
    public function Delete($id, ProductsRepository $pr){
        $em=$this->getDoctrine()->getManager();
        $product = $pr ->find($id);
        $em->remove($product);
        $em->flush();
        $this->addFlash('delete','Product Deleted!');
        return $this->redirect($this->generateUrl('admin'));
    }


    #[Route('/update/{id}', name: 'update')]
    public function Update($id, Request $request){
        
        $product=new Products();
        $product=$this->getDoctrine()->getRepository(Products::class)->find($id);
        $Form =$this->createFormBuilder($product) 
        ->add('title') 
        ->add('author')
        ->add('image')
        ->add('price')
        ->add('category')
        ->add('quantity')
        ->add('content')
        ->add('Update', SubmitType::class)
        ->getForm();

        $Form->handleRequest($request);

        if ($Form->isSubmitted() && $Form->isValid()) { 
            $product = $Form->getData();
            $em=$this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();
            $this->addFlash('updated','Product Updated!');
            return $this->redirect($request->getUri());
        }
        
        //Respone
        return $this->render('admin/update.html.twig', [
            'form' => $Form->createView(),
            'Product' => $product,
        ]);
    }

}
