<?php

namespace App\Controller;

use App\Entity\Commentary;
use App\Form\CommentaryType;
use App\Repository\CommentaryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/commentary')]
class AdminCommentaryController extends AbstractController
{
    #[Route('/', name: 'admin_commentary_index', methods: ['GET'])]
    public function index(CommentaryRepository $commentaryRepository): Response
    {
        return $this->render('admin_commentary/index.html.twig', [
            'commentaries' => $commentaryRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'admin_commentary_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $commentary = new Commentary();
        $form = $this->createForm(CommentaryType::class, $commentary);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($commentary);
            $entityManager->flush();

            return $this->redirectToRoute('admin_commentary_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_commentary/new.html.twig', [
            'commentary' => $commentary,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_commentary_show', methods: ['GET'])]
    public function show(Commentary $commentary): Response
    {
        return $this->render('admin_commentary/show.html.twig', [
            'commentary' => $commentary,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin_commentary_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Commentary $commentary, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CommentaryType::class, $commentary);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('admin_commentary_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_commentary/edit.html.twig', [
            'commentary' => $commentary,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_commentary_delete', methods: ['POST'])]
    public function delete(Request $request, Commentary $commentary, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commentary->getId(), $request->request->get('_token'))) {
            $entityManager->remove($commentary);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_commentary_index', [], Response::HTTP_SEE_OTHER);
    }
}
