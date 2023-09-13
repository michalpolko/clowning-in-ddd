<?php

namespace App\BlogAdmin\Application\Command;

use App\BlogAdmin\Domain\Blog\Model\ValueObject\AuthorId;
use App\BlogAdmin\Domain\Blog\Model\ValueObject\DraftId;

readonly class AuthorStartWritingNewDraftCommand
{
    public function __construct(
        public AuthorId $authorId,
        public DraftId $draftId,
    ) {
    }
}
