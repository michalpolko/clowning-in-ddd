<?php

namespace App\BlogAdmin\Domain\Blog\Event;

use App\Shared\Domain\Model\DomainEvent;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class AuthorStartedWritingNewDraft extends DomainEvent
{
    public function __construct(
        public readonly UuidInterface $authorId,
        public readonly UuidInterface $draftId,
    ) {
        $this->eventId = Uuid::uuid4();
    }
}
