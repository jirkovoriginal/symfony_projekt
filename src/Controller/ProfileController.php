<?php

namespace App\Controller;

use App\Repository\UzivatelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Form\UpdatePasswordType;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function show(
        Request $request,
        UzivatelRepository $userRepository,
        UserPasswordHasherInterface $passwordHasher
    ): Response {
        $this->denyAccessUnlessGranted('ROLE_UZIVATEL');
        

        $updatePasswordForm = $this->createForm(UpdatePasswordType::class);
        $updatePasswordForm->handleRequest($request);

        if ($updatePasswordForm->isSubmitted() && $updatePasswordForm->isValid()) {
            $user = $this->getUser();
            $newPassword = $updatePasswordForm->get('password')->getData();

            $hashedPassword = $passwordHasher->hashPassword($user, $newPassword);
            $userRepository->upgradePassword($user, $hashedPassword);

            $this->addFlash('success', 'Heslo bylo změněno.');
            return $this->redirectToRoute('app_profile');
        }elseif ($updatePasswordForm->isSubmitted() ){
            $this->addFlash('error', 'Heslo nebylo změněno. Pravděpodobně se políčka neshodují nebo bylo zadáno méně než šest znaků.');
        }

        return $this->render('profile/show.html.twig', [
            'update_password_form' => $updatePasswordForm,
        ]);
    }
}