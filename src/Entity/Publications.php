<?php

namespace App\Entity;

use App\Repository\PublicationsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PublicationsRepository::class)]
class Publications
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    private ?string $type = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?string $uid = null;

    #[ORM\Column(length: 255)]
    private ?string $url = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $published_at = null;

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private array $images = [];

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private ?array $source = [];

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private ?array $author = [];

    public function __toString(): string
    {
//        return $this->id . ' ' . $this->content;
        return $this->id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getUid(): ?string
    {
        return $this->uid;
    }

    public function setUid(string $uid): self
    {
        $this->uid = $uid;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getPublishedAt(): ?string
    {
        return $this->published_at;
    }

    public function setPublishedAt(string $published_at): self
    {
        $this->published_at = $published_at;

        return $this;
    }

    public function getImages(): array
    {
        return $this->images;
    }

    public function setImages(?array $images): self
    {
        $this->images = $images;

        return $this;
    }

    public function getSource(): array
    {
        return $this->source;
    }

    public function setSource(?array $source): self
    {
        $this->source = $source;

        return $this;
    }

    public function getAuthor(): array
    {
        return $this->author;
    }

    public function setAuthor(?array $author): self
    {
        $this->author = $author;

        return $this;
    }
}
