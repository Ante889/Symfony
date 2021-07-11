<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController
{
    /**
     * @Route("/")
     */
    public function homepage()
    {
        
       return new Response('Hello world'); 

    }

    /**
     * @Route("/questions/{slug}")
     */

    public function show($slug)
    {

        return new Response("Future page to show a question! ". $slug);

    }

}


?>