<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Genres;
use App\Form\GenresType;
use App\Repository\GenresRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;
use Twig\Extra\String\StringExtension;

#[Route('/genres')]
class GenresControlles extends AbstractController
{
    #[Route('/', name: 'app_genre_index')]
    public function index(GenresRepository $genreRepository, PaginatorInterface $paginatorInterface,Request $request): Response
    {
        $data = $genreRepository->findAll();
        $genres = $paginatorInterface->paginate(
            $data,
            $request->query->getInt('page',1),
            10
        );
        return $this->render('genres/index.html.twig', [
            'genres' => $genres,
        ]);
    }

    #[Route('/new', name: 'app_genre_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $genres = new Genres();
        $form = $this->createForm(GenresType::class, $genres);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($genres);
            $entityManager->flush();

            $this->addFlash('succes','l genres a ete ajoute');
            
            return $this->redirectToRoute('app_genre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('genres/new.html.twig', [
            'genres' => $genres,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_genre_show', methods: ['GET'])]
    public function show(Genres $genres): Response
    {
        return $this->render('genre/show.html.twig', [
            'genres' => $genres,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_genre_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Genre $genres, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(GenreType::class, $genre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_genre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('genre/edit.html.twig', [
            'genres' => $genres,
            'form' => $form,
        ]);
    }

    #[Route('/delete/{id}', name: 'app_genre_delete')]
    public function delete(Request $request, Genre $genre, EntityManagerInterface $entityManager): Response
    {
            $entityManager->remove($genres);
            $entityManager->flush();
        
        return $this->redirectToRoute('app_genre_index');
    }
}
