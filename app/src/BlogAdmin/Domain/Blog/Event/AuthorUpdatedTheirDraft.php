<?php

namespace App\BlogAdmin\Domain\Blog\Event;

use App\Shared\Domain\Model\DomainEvent;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class AuthorUpdatedTheirDraft extends DomainEvent
{
    public function __construct(
        public readonly UuidInterface $authorId,
        public readonly UuidInterface $draftId,
        public readonly string $title,
        public readonly string $content,
        public readonly ?UuidInterface $categoryId,
    ) {
        $this->eventId = Uuid::uuid4();
    }
}
