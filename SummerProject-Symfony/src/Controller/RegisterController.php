<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\DBAL\Types\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegisterController extends AbstractController
{
    
    #[Route('/reg', name: 'reg')]
    public function reg(Request $request, UserPasswordHasherInterface $passwordHasher)
    {

        $regForm = $this-> createFormBuilder()
        ->add('email')
        ->add('password',RepeatedType::class,[
            'type' => PasswordType::class,
            'required' => true,
            'first_options' => ['label' => 'Password'],
            'second_options' => ['label' => 'Confirm Password']
        ])
        ->add('register', SubmitType::class)
        ->getForm()    
        ;

        $regForm->handleRequest($request);
        
        if ($regForm->isSubmitted()){

            $input= $regForm->getData();
            $user = new User();
            $user->setEmail($input['email']);
            $user->setPassword($passwordHasher->hashPassword($user,$input['password']));
            $em = $this->getDoctrine()->getManager();
            $em-> persist($user);
            $em-> flush();
            $this->addFlash('success','User created!');
            return $this->redirect($request->getUri());
        }

        return $this->render('register/index.html.twig', [
            'regForm' => $regForm->createView(),
        ]);
    }
}
