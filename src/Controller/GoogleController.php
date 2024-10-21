<?php

namespace App\Controller;

use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class GoogleController extends AbstractController
{
    #[Route('/connect/google', name: 'connect_google_start')]
    public function connectAction(ClientRegistry $clientRegistry): Response
    {
        return $clientRegistry->getClient('google')->redirect([
            'email', 'profile'
        ], []);
    }

        #[Route('/connect/google/check', name: 'connect_google_check')]
    public function connectCheckAction(Request $request, ClientRegistry $clientRegistry)
    {
        // Cette méthode ne devrait pas être appelée directement.
        return $this->redirectToRoute('home');
    }

    #[Route('/debug-env', name: 'debug_env')]
    public function debugEnv(): Response
    {
        $clientId = $_ENV['GOOGLE_CLIENT_ID'] ?? 'Not found';
        $clientSecret = $_ENV['GOOGLE_CLIENT_SECRET'] ?? 'Not found';

        return new Response("Client ID: $clientId, Client Secret: $clientSecret");
    }
}