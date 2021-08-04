<?php

namespace App\Controller;

use App\Entity\User;
use App\Services\GiftsServices;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    

    public function __construct(GiftsServices $gifts)
    {
        $gifts->gifts = ['a','b','c','d'];
    }

    #[Route('/', name: 'default')]
    public function index(GiftsServices $gifts)
    {
        $users = $this-> getDoctrine()->getRepository(User::class)->findAll();

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'users' => $users,
            'random_gift' => $gifts-> gifts,
        ]);
    }
    #[Route('blog/{page?}', name: 'blog_list')]

    public function index2()
    {
        return new Response('Something');
    }
}
