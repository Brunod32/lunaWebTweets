<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Publications;
use App\Entity\Source;
use App\Entity\Author;
use App\Entity\Avatar;

class DataService
{
    private HttpClientInterface $client;
    private EntityManagerInterface $entityManager;

    public function __construct(HttpClientInterface $client, EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->client = $client;
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function dataFromTwitter()
    {
        $key = $_SERVER['API_KEY'];

        // Récupération des données de Twitter
        $response = $this->client->request(
            'GET',
            $key
        );

        $data = $response->toArray();
        print_r($data['publications']);

        foreach($data['publications'] as $item) {
            $donnees = $item['author']['avatar']['large'];
            print_r($donnees);
        }

        // Enregistrement des données en BDD
        foreach($data['publications'] as $item) {
            $source = new Source();
            if(isset($_GET['settings_id'])) {
                $source->setSettingsId($item['source']['settings_id']);
                $source->setType($item['source']['type']);
            }

            $avatar = new Avatar();
            if(isset($_GET['author']['avatar']['large'])) {
                $avatar->setLarge($item['author']['avatar']['large']);
            }

            $author = new Author();
            if(isset($_GET['author']['avatar_id'])) {
                $author->setAvatar($item['author']['avatar_id']);
                $author->setScreenName($item['author']['screen_name']);
                $author->setFullName($item['author']['full_name']);
                $author->setuid($item['author']['uid']);
                $author->setUrl($item['author']['url']);
            }

            $publication = new Publications();
            if($item['type'] === 'twitter') {
                $publication->setType($item['type']);
                $publication->setUid($item['uid']);
                $publication->setUrl($item['url']);
                $publication->setTitle($item['title']);
                $publication->setDescription($item['description']);
                $publication->setContent($item['content']);
                $publication->setPublishedAt($item['published_at']);
                $publication->setImages($item['images']);
                $publication->setSource($item['source']);
                $publication->setAuthor($item['author']);
            }

            $this->entityManager->persist($publication);

        }
        $this->entityManager->flush();

    }

}