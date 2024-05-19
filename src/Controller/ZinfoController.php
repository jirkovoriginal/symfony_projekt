<?php

namespace App\Controller;

use App\Entity\Zinfo;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ZinfoController extends AbstractController
{
    #[Route('/{odkaz}', name: 'app_zinfo')]
    public function show(Zinfo $zinfo): Response
    {
        return $this->render('zinfo/zinfo.html.twig', [
            'zinfo' => $zinfo,
        ]);
    }
}