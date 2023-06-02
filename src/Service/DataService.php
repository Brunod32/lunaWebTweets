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
        print_r($data);

        // Enregistrement des données en BDD
        foreach($data as $item) {
            $source = new Source();
            if(isset($_GET['settings_id'])) {
                $source->setSettingsId($item['settings_id']);
                $source->setType($item['type']);
            }

            $avatar = new Avatar();
            if(isset($_GET['large'])) {    
                $avatar->setLarge($item['large']);
            }

            $author = new Author();
            if(isset($_GET['avatar_id'])) {
                $author->setAvatar($item['avatar_id']);
                $author->setScreenName($item['screen_name']);
                $author->setFullName($item['full_name']);
                $author->setuid($item['uid']);
                $author->setUrl($item['url']);
            }

            $publication = new Publications();
            if(!empty($_GET['type'])) {
                $publication->setType($item['type']);
                $publication->setUid($item['uid']);
                $publication->setUrl($item['url']);
                $publication->setTitle($item['title']);
                $publication->setDescription($item['description']);
                $publication->setContent($item['content']);
                $publication->setPublishedAt($item['published_at']);
                $publication->setImages($item['images']);
                $publication->setSource($item['source_id']);
                $publication->setAuthor($item['author_id']);
            }

            $this->entityManager->persist($publication);

        }
        $this->entityManager->flush();

    }

}