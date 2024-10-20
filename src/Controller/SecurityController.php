<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class SecurityController extends AbstractController
{
    #[Route(path: '/register', name: 'app_register', methods: ['GET', 'POST'])]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHashed, EntityManagerInterface $entityManager, UserRepository $ur,SluggerInterface $slugger): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('image')->getData();

            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imageFile->guessExtension();
    
                try {
                    // Déplacement du fichier dans un dossier sécurisé
                    $imageFile->move(
                        $this->getParameter('images_directory'), // Assure-toi que ce paramètre est configuré
                        $newFilename
                    );
                    $user->setImage($newFilename); // Assure-toi d'avoir un setter pour l'image dans l'entité User
                } catch (FileException $e) {
                    // Gérer l'exception si le fichier n'a pas pu être déplacé
                }
                // Mettre à jour le nom de l'image dans l'entité User
                $user->setImage($newFilename);
            }
    

            /** @var string $plainPassword */
            $password = $form->get('password')->getData();
            $confirmPassword = $form->get('confirmPassword')->getData();
            $email = $form->get('email')->getData();

            $existingEmail = $ur->findByEmail($email);
            
            if ($existingEmail) {
                $this->addFlash(
                    'error',
                    'Email déjà utilisé, merci de vous connecter.'
                );

                return $this->redirectToRoute('app_register', [
                    'registrationForm' => $form,
                ]);
            }

            if ($password === $confirmPassword) {
                // encode the plain password
                $user->setPassword($userPasswordHashed->hashPassword($user, $password));

                $entityManager->persist($user);
                $entityManager->flush();

                $this->addFlash(
                    'success',
                    'Inscription réussie ! Vous pouvez dés à présent vous connecter.'
                );

                return $this->redirectToRoute('app_login');

            } else {
                $this->addFlash(
                    'error',
                    'La confirmation du mot de passe doit être identique au mot de passe.'
                );
                return $this->redirectToRoute('app_register', [
                    'registrationForm' => $form,
                ]);
            }
        }

        return $this->render('security/register.html.twig', [
            'registrationForm' => $form,
        ]);
    }

    #[Route(path: '/login', name: 'app_login', methods: ['GET', 'POST'])]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
