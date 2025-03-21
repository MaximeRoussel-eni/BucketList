<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(): Response
    {
        return $this->render('main/index.html.twig');
    }
    #[Route('/test', name: 'app_main_test')]
    public function test(): Response
    {
        return $this->render('main/test.html.twig');
    }
    #[Route('/about_us', name: 'app_main_aboutUs')]
    public function aboutUs(): Response
    {
        return $this->render('main/aboutUs.html.twig');
    }
}
