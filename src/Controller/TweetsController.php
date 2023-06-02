<?php

namespace App\Controller;

use App\Repository\PublicationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TweetsController extends AbstractController
{
    #[Route('/tweets', name: 'app_tweets')]
    public function index(PublicationsRepository $publications): Response
    {
        return $this->render('tweets/index.html.twig', [
            'tweets' => $publications->findAll()
        ]);
    }
}
