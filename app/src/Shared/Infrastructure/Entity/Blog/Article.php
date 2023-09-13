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

#[Entity()]
#[Table(name: 'blog_article')]
class Article
{
    #[Id]
    #[GeneratedValue()]
    #[Column()]
    public ?int $id = null;

    public function __construct(
        #[Column(type: 'uuid')]
        public UuidInterface $uuid,
        #[Column(length: 150)]
        public string $title,
        #[Column(type: 'text', length: 16777215)]
        public string $content,
        #[ManyToOne(targetEntity: Category::class)]
        #[JoinColumn(nullable: true)]
        public ?Category $category,
        #[Column(type: 'boolean')]
        public bool $isDraft,
    ) {
    }
}
