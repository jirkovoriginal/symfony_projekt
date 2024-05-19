<?php

namespace App\Controller;

use App\Repository\PrispevekRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomepageController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function index(PrispevekRepository $prispevekRepository): Response
    {

        $prispevky = $prispevekRepository->findBy([], ['id' => 'DESC'], 5);

        return $this->render('homepage/index.html.twig', [
            'prispevky' => $prispevky,
        ]);
    }
}
