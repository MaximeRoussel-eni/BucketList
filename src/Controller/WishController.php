<?php

namespace App\Controller;
use App\Entity\Wish;
use App\Form\WishType;
use App\Repository\WishRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request; // ✅ Bon import

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class WishController extends AbstractController
{
    #[Route('/liste', name: 'app_main_list')]
    public function list(WishRepository $wishRepository): Response
    {
        $wishes = $wishRepository->findAll();
        return $this->render('main/list.html.twig', ['wishes' => $wishes]);
    }
    #[Route('/create', name: 'app_main_create')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $wish = new Wish();
        $form = $this->createForm(WishType::class, $wish); // ✅ Correction ici

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $wish->setDateCreated(new \DateTime()); // Ajout de la date de création
            $wish->setDateUpdated(new \DateTime()); // Ajout de la date de mise à jour
            $wish->setAuthor($this->getUser()->getFirstname());
            $entityManager->persist($wish);
            $entityManager->flush();

            $this->addFlash('success', 'Votre souhait a été ajouté avec succès !');
            return $this->redirectToRoute('app_main_list');
        }

        return $this->render('main/createIdea.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('/liste/{id}', name: 'app_main_detail',requirements: ['id'=>'\d+'])]
    public function detail(WishRepository $wishRepository, int $id): Response
    {
        $wish = $wishRepository->find($id);
        return $this->render('main/detail.html.twig',['wish' => $wish]);
    }
    #[Route('/liste/delete/{id}', name: 'app_main_delete', requirements: ['id' => '\d+'], methods: ['POST', 'GET'])]
    public function delete(WishRepository $wishRepository, EntityManagerInterface $entityManager, int $id): Response
    {
        $wish = $wishRepository->find($id);

        if (!$wish) {
            throw $this->createNotFoundException('L\'idée demandée n\'existe pas.');
        }

        $entityManager->remove($wish);
        $entityManager->flush();

        $this->addFlash('success', 'L\'idée a été supprimée.');

        return $this->redirectToRoute('app_main_list');
    }



}