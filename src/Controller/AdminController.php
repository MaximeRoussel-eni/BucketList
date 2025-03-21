<?php

namespace App\Controller;

use App\Repository\WishRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AdminController extends AbstractController
{
    /*#[Route('/admin', name: 'app_admin_dashboard')]
    public function dashboard(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }*/
    #[Route('/admin', name: 'app_admin_dashboard')]
    public function dashboard(WishRepository $wishRepository): Response
    {

        $wishes = $wishRepository->findAll();
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'wishes' => $wishes
        ]);
    }

}
