<?php

namespace App\Controller;

use App\Entity\Loan;
use App\Form\LoanType;
use App\Repository\LoanRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/loan')]
class LoanController extends AbstractController
{
    #[Route('/', name: 'app_loan_index', methods: ['GET'])]
    public function index(LoanRepository $loanRepository): Response
    {
        return $this->render('loan/index.html.twig', [
            'loans' => $loanRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_loan_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $loan = new Loan();
        $form = $this->createForm(LoanType::class, $loan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($loan);
            $entityManager->flush();

            return $this->redirectToRoute('app_loan_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('loan/new.html.twig', [
            'loan' => $loan,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_loan_show', methods: ['GET'])]
    public function show(Loan $loan): Response
    {
        return $this->render('loan/show.html.twig', [
            'loan' => $loan,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_loan_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Loan $loan, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LoanType::class, $loan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_loan_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('loan/edit.html.twig', [
            'loan' => $loan,
            'form' => $form,
        ]);
    }

    #[Route('/delete/{id}', name: 'app_loan_delete')]
    public function delete(Request $request, Loan $loan, EntityManagerInterface $entityManager): Response
    {
            $entityManager->remove($loan);
            $entityManager->flush();
        

        return $this->redirectToRoute('app_loan_index');
    }
}
