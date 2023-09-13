<?php

namespace App\Shared\Infrastructure\Entity\Blog;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Ramsey\Uuid\UuidInterface;

#[Entity]
#[Table(name: 'blog_article_rating')]
class ArticleRating
{
    #[Id]
    #[GeneratedValue]
    #[Column]
    public ?int $id = null;

    public function __construct(
        #[Column(type: 'uuid')]
        public UuidInterface $uuid,
        #[Column]
        public int $rating,
        #[ManyToOne(targetEntity: Article::class)]
        #[JoinColumn(nullable: false)]
        public Article $article,
        #[Column(length: 15)]
        public string $addedByIp,
        #[Column]
        public \DateTimeImmutable $addedAt,
    ) {
    }
}
