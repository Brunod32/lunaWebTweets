<?php

namespace App\Controller;

use App\Repository\PublicationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TweetsController extends AbstractController
{
    #[Route('/tweets', name: 'app_tweets')]
    #[Route('/tweets/{page}', name: 'app_tweets_pagination', methods: ['GET'])]
    public function index(PublicationsRepository $publications, int $page = 1): Response
    {
        $nbTweets = $publications->findTweetsPaginationCount();
        return $this->render('tweets/index.html.twig', [
            //'tweets' => $publications->findAll(),
            'tweets' => $publications->findTweetsPagination($page),
            'currentPage' => $page,
            'maxTweets' => $nbTweets > ($page * 4)
        ]);
    }
}
