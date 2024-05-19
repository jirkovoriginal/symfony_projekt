<?php

namespace App\Controller;

use Amp\Http\Client\Request;
use App\Entity\Prispevek;
use App\Form\PostType;
use App\Repository\PrispevekRepository;
use App\Service\ImageUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(PrispevekRepository $prispevekRepository): Response
    {

        $prispevky = $prispevekRepository->findBy([], ['id' => 'DESC'], 5);

        return $this->render('admin/index.html.twig', [
            'prispevky' => $prispevky,
        ]);
    }
    #[Route('/admin/novy', name: 'app_create_post_admin')]
    public function create(Request $request, ImageUploader $imageUploader): Response
    {
        $post = new Prispevek();
        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $post->setAutor($this->getUser());

            $image = $form->get('image')->getData();
            $imageUploadError = false;

            if ($image) {
                $imageName = $imageUploader->upload($image);
                $post->setObrazek1($imageName);
                $imageUploadError = !$imageName;
            }

            $this->entityManager->persist($post);
            $this->entityManager->flush();

            if ($imageUploadError) {
                $this->addFlash('error', 'Článek byl úspěšně přidán, ale nepodařilo se nahrát obrázek.');
            } else {
                $this->addFlash('success', 'Článek byl úspěšně přidán.');
            }

            return $this->redirectToRoute('app_edit_post_admin', ['slug' => $post->getSlug()]);
        }

        return $this->render('admin/create.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/admin/{slug}/uprava', name: 'app_edit_post_admin')]
    public function edit(
        Request $request,
        Prispevek $post,
        ImageUploader $imageUploader,
        ParameterBagInterface $parameterBag
    ): Response {
        $editForm = $this->createForm(PostType::class, $post);
        $deleteForm = $this->createForm(DeletePostType::class);

        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $oldImage = $post->getImage();
            $image = $editForm->get('image')->getData();
            $imageUploadError = false;

            if ($image) {
                $imageName = $imageUploader->upload($image);
                $post->setImage($imageName);
                $imageUploadError = !$imageName;
            }

            if (!$imageUploadError && $oldImage) {
                $imagesDirectory = $parameterBag->get('image_directory');
                unlink("$imagesDirectory/$oldImage");
            }

            $this->entityManager->persist($post);
            $this->entityManager->flush();

            if ($imageUploadError) {
                $this->addFlash('error', 'Článek byl úspěšně upraven, ale nepodařilo se nahrát obrázek.');
            } else {
                $this->addFlash('success', 'Článek byl úspěšně upraven.');
            }

            return $this->redirectToRoute('app_edit_post_admin', ['slug' => $post->getSlug()]);
        }


        return $this->render('admin/edit.html.twig', [
            'post' => $post,
            'edit_form' => $editForm,
            'delete_form' => $deleteForm
        ]);
    }

    #[Route('/admin/{slug}/odstraneni', name: 'app_delete_post_admin', methods: ['POST'])]
    public function destroy(Request $request, Post $post, ParameterBagInterface $parameterBag): Response
    {
        $form = $this->createForm(DeletePostType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($post->getImage()) {
                unlink($parameterBag->get('image_directory') . '/' . $post->getImage());
            }

            $this->entityManager->remove($post);
            $this->entityManager->flush();

            $this->addFlash('success', 'Článek byl odstraněn.');
            return $this->redirectToRoute('app_posts_admin');
        }

        $this->addFlash('error', 'Článek se nepodařilo odstranit.');
        return $this->redirectToRoute('app_edit_post_admin', ['slug' => $post->getSlug()]);
    }
}