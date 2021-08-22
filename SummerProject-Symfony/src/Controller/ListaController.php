<?php

namespace App\Controller;

use App\Entity\Lista;
use App\Form\ListaType;
use App\Repository\ListaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/lista')]
class ListaController extends AbstractController
{
    #[Route('/', name: 'lista_index', methods: ['GET'])]
    public function index(ListaRepository $listaRepository): Response
    {
        return $this->render('lista/index.html.twig', [
            'listas' => $listaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'lista_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $listum = new Lista();
        $form = $this->createForm(ListaType::class, $listum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($listum);
            $entityManager->flush();

            return $this->redirectToRoute('lista_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('lista/new.html.twig', [
            'listum' => $listum,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'lista_show', methods: ['GET'])]
    public function show(Lista $listum): Response
    {
        return $this->render('lista/show.html.twig', [
            'listum' => $listum,
        ]);
    }

    #[Route('/{id}/edit', name: 'lista_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Lista $listum): Response
    {
        $form = $this->createForm(ListaType::class, $listum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('lista_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('lista/edit.html.twig', [
            'listum' => $listum,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'lista_delete', methods: ['POST'])]
    public function delete(Request $request, Lista $listum): Response
    {
        if ($this->isCsrfTokenValid('delete'.$listum->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($listum);
            $entityManager->flush();
        }

        return $this->redirectToRoute('lista_index', [], Response::HTTP_SEE_OTHER);
    }
}
