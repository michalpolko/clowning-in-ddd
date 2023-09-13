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
#[Table(name: 'blog_category')]
class Category
{
    #[Id]
    #[GeneratedValue]
    #[Column]
    public ?int $id = null;

    public function __construct(
        #[Column(type: 'uuid')]
        public UuidInterface $uuid,
        #[Column(length: 100)]
        public string $name,
        #[ManyToOne(targetEntity: Category::class)]
        #[JoinColumn(nullable: true)]
        public ?Category $parent,
    ) {
    }
}
