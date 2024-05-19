<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Prispevek;
use App\Form\DeletePostType;
use App\Form\PostType;
use App\Repository\PrispevekRepository;
use App\Service\ImageUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\UnicodeString;

class PostController extends AbstractController
{
    public function __construct(
        private PrispevekRepository $postRepository,
        private EntityManagerInterface $entityManager
    ) {
    }

    #[Route('/admin/prispevky', name: 'app_posts_admin')]
    public function indexAdmin(Request $request): Response
    {

        return $this->render('post/index_admin.html.twig', [
        ]);
    }
}