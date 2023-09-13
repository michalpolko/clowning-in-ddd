<?php

namespace App\BlogAdmin\Domain\Blog\Model\Entity;

use App\BlogAdmin\Domain\Blog\Model\ValueObject\ArticleId;
use App\BlogAdmin\Domain\Blog\Model\ValueObject\CategoryId;
use App\BlogAdmin\Domain\Blog\Model\ValueObject\Content;
use App\BlogAdmin\Domain\Blog\Model\ValueObject\Title;
use App\Shared\Domain\Model\AggregateRoot;
use App\Shared\Domain\Model\AggregateRootTrait;
use App\Shared\Domain\Model\DomainEvent;
use Ramsey\Uuid\UuidInterface;

final class Article implements AggregateRoot
{
    use AggregateRootTrait;

    private ArticleId $id;
    private Title $title;
    private Content $content;
    private CategoryId $categoryId;

    private function __construct()
    {
    }

    public static function publishDraft(Draft $draft): self
    {
        if (!$draft->hasEverythingRequiredForPublishing()) {
            throw new \Exception('ArticleCannotBePublishedException');
        }

        $article = new self();

        $article->id = new ArticleId($draft->getId()->value);
        $article->title = new Title($draft->getTitle()->value);
        $article->content = new Content($draft->getContent()->value);
        $article->categoryId = $draft->getCategoryId();

        return $article;
    }

    public function getId(): ArticleId
    {
        return $this->id;
    }

    public function getAggregateRootId(): UuidInterface
    {
        return $this->id->value;
    }

    public function getTitle(): Title
    {
        return $this->title;
    }

    public function getContent(): Content
    {
        return $this->content;
    }

    public function getCategoryId(): CategoryId
    {
        return $this->categoryId;
    }

    public function apply(DomainEvent $domainEvent): void
    {
    }
}
