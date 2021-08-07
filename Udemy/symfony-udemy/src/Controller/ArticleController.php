<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    #[Route('/article', name: 'article')]
    public function index(Request $request): Response
    {

        $article = new Article();
        $article->setTitle('Title is this');
        $em = $this -> getDoctrine()->getManager();
        //$em->persist($article);
        //$em -> flush();


        $getArticle = $em -> getRepository(Article::class)->findOneBy([
            'id' => 1
        ]);

        $em->remove($getArticle);
        $em -> flush();


        //return new Response('Article was created');

        return $this->render('article/index.html.twig', [
            'article' => $getArticle,
        ]);
    }
}
