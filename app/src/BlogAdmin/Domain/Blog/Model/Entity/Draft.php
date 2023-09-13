<?php

namespace App\BlogAdmin\Domain\Blog\Model\Entity;

use App\BlogAdmin\Domain\Blog\Event\AuthorStartedWritingNewDraft;
use App\BlogAdmin\Domain\Blog\Event\AuthorUpdatedTheirDraft;
use App\BlogAdmin\Domain\Blog\Model\ValueObject\AuthorId;
use App\BlogAdmin\Domain\Blog\Model\ValueObject\CategoryId;
use App\BlogAdmin\Domain\Blog\Model\ValueObject\Content;
use App\BlogAdmin\Domain\Blog\Model\ValueObject\DraftId;
use App\BlogAdmin\Domain\Blog\Model\ValueObject\Title;
use App\Shared\Domain\Model\AggregateRoot;
use App\Shared\Domain\Model\AggregateRootTrait;
use App\Shared\Domain\Model\DomainEvent;
use Ramsey\Uuid\UuidInterface;

final class Draft implements AggregateRoot
{
    use AggregateRootTrait;

    private DraftId $id;
    private AuthorId $authorId;
    private Title $title;
    private Content $content;
    private ?CategoryId $categoryId;

    private function __construct()
    {
    }

    public static function authorStartsWritingNewDraft(
        AuthorId $authorId,
        DraftId $draftId,
    ): self {
        $aggregateRoot = new self();
        $aggregateRoot->applyAndEmit(new AuthorStartedWritingNewDraft($authorId->value, $draftId->value));

        return $aggregateRoot;
    }

    public function authorUpdatesTheirDraft(Title $title, Content $content, ?CategoryId $categoryId): void
    {
        $this->applyAndEmit(new AuthorUpdatedTheirDraft(
            $this->authorId->value,
            $this->id->value,
            $title->value,
            $content->value,
            $categoryId->value,
        ));
    }

    public function publish(): Article
    {
        return Article::publishDraft($this);
    }

    public function hasEverythingRequiredForPublishing(): bool
    {
        if (!$this->title) {
            return false;
        }

        if (!$this->content) {
            return false;
        }

        if (!$this->categoryId) {
            return false;
        }

        return true;
    }

    private function apply(DomainEvent $domainEvent): void
    {
        if ($domainEvent instanceof AuthorStartedWritingNewDraft) {
            $this->handleAuthorStartedWritingNewDraft($domainEvent);
        } elseif ($domainEvent instanceof AuthorUpdatedTheirDraft) {
            $this->handleAuthorUpdatedTheirDraft($domainEvent);
        }
    }

    private function handleAuthorStartedWritingNewDraft(AuthorStartedWritingNewDraft $domainEvent): void
    {
        $this->id = $domainEvent->draftId;
        $this->authorId = $domainEvent->authorId;
        $this->title = new Title('');
        $this->content = new Content('');
        $this->categoryId = null;
    }

    private function handleAuthorUpdatedTheirDraft(AuthorUpdatedTheirDraft $domainEvent): void
    {
        $this->title = new Title($domainEvent->title);
        $this->content = new Content($domainEvent->content);
        $this->categoryId = new CategoryId($domainEvent->categoryId);
    }

    public function getId(): DraftId
    {
        return $this->id;
    }

    public function getAggregateRootId(): UuidInterface
    {
        return $this->id->value;
    }

    public function getAuthorId(): AuthorId
    {
        return $this->authorId;
    }

    public function getTitle(): Title
    {
        return $this->title;
    }

    public function getContent(): Content
    {
        return $this->content;
    }

    public function getCategoryId(): ?CategoryId
    {
        return $this->categoryId;
    }
}
