<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BookRepository::class)
 */
class Book
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64, unique=true)
     */
    private $book_id;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $etag;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $selfLink;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $epub;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pdf;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=12, nullable=true)
     */
    private $currencyCode;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $buyLink;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $subtitle;

    /**
     * @ORM\Column(type="array")
     */
    private $authors = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $publisher;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $publishedDate;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $pageCount;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $categories = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $contentVersion;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imageLink;

    /**
     * @ORM\Column(type="string", length=32, nullable=true)
     */
    private $language;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBookId(): ?string
    {
        return $this->book_id;
    }

    public function setBookId(string $book_id): self
    {
        $this->book_id = $book_id;

        return $this;
    }

    public function getEtag(): ?string
    {
        return $this->etag;
    }

    public function setEtag(?string $etag): self
    {
        $this->etag = $etag;

        return $this;
    }

    public function getSelfLink(): ?string
    {
        return $this->selfLink;
    }

    public function setSelfLink(?string $selfLink): self
    {
        $this->selfLink = $selfLink;

        return $this;
    }

    public function getEpub(): ?string
    {
        return $this->epub;
    }

    public function setEpub(?string $epub): self
    {
        $this->epub = $epub;

        return $this;
    }

    public function getPdf(): ?string
    {
        return $this->pdf;
    }

    public function setPdf(?string $pdf): self
    {
        $this->pdf = $pdf;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCurrencyCode(): ?string
    {
        return $this->currencyCode;
    }

    public function setCurrencyCode(?string $currencyCode): self
    {
        $this->currencyCode = $currencyCode;

        return $this;
    }

    public function getBuyLink(): ?string
    {
        return $this->buyLink;
    }

    public function setBuyLink(?string $buyLink): self
    {
        $this->buyLink = $buyLink;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSubtitle(): ?string
    {
        return $this->subtitle;
    }

    public function setSubtitle(?string $subtitle): self
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    public function getAuthors(): ?array
    {
        return $this->authors;
    }

    public function setAuthors(array $authors): self
    {
        $this->authors = $authors;

        return $this;
    }

    public function getPublisher(): ?string
    {
        return $this->publisher;
    }

    public function setPublisher(?string $publisher): self
    {
        $this->publisher = $publisher;

        return $this;
    }

    public function getPublishedDate(): ?string
    {
        return $this->publishedDate;
    }

    public function setPublishedDate(?string $publishedDate): self
    {
        $this->publishedDate = $publishedDate;

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

    public function getPageCount(): ?int
    {
        return $this->pageCount;
    }

    public function setPageCount(?int $pageCount): self
    {
        $this->pageCount = $pageCount;

        return $this;
    }

    public function getCategories(): ?array
    {
        return $this->categories;
    }

    public function setCategories(?array $categories): self
    {
        $this->categories = $categories;

        return $this;
    }

    public function getContentVersion(): ?string
    {
        return $this->contentVersion;
    }

    public function setContentVersion(?string $contentVersion): self
    {
        $this->contentVersion = $contentVersion;

        return $this;
    }

    public function getImageLink(): ?string
    {
        return $this->imageLink;
    }

    public function setImageLink(string $imageLink): self
    {
        $this->imageLink = $imageLink;

        return $this;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(?string $language): self
    {
        $this->language = $language;

        return $this;
    }
}
