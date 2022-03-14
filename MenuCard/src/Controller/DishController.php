<?php

namespace App\Controller;

use App\Entity\Dish;
use App\Form\DishType;
use App\Repository\DishRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/dish', name: 'edit.')]
class DishController extends AbstractController
{
    #[Route('/', name: 'app_dish')]
    public function index(DishRepository $dish) /* Response */
    {
        $dish = $dish ->findAll();

        return $this->render('dish/index.html.twig', [
            'dishs' => $dish,
        ]);
    }

    #[Route('/delete/{id}', name: 'delete')]
    public function delete(DishRepository $dish, $id) /* Response */
    {
        $en = $this -> getDoctrine()->getManager();
        $dish = $dish ->findOneBy([
            'id' => $id
        ]);
        $en->remove($dish);
        $en->flush();

        $this -> addFlash('Success', 'Succesfuly deleted dish');
        return $this -> redirect($this->generateUrl('edit.app_dish'));
    }

    #[Route('/create', name: 'create')]
    public function create (Request $request) {
        $dish = new Dish();
        $dish -> setName('Pizza');
        $form = $this->createForm(DishType::class, $dish);
        $form = $form->handleRequest($request);
               
        if ($form->isSubmitted() && $form->isValid()) { 
            $en = $this -> getDoctrine()->getManager();
            $en -> persist($dish);
            $en -> flush();
            return $this -> redirect($this->generateUrl('edit.app_dish'));
        }
        
        return $this->render('dish/create.html.twig', [
            'createForm' => $form->createView(),
        ]);
    }
}
