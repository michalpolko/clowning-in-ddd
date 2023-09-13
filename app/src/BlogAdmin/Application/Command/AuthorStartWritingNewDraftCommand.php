<?php

namespace App\BlogAdmin\Application\Command;

use App\BlogAdmin\Domain\Blog\Model\AuthorId;
use App\BlogAdmin\Domain\Blog\Model\DraftId;

readonly class AuthorStartWritingNewDraftCommand
{
    public function __construct(
        public AuthorId $authorId,
        public DraftId $draftId,
    ) {
    }
}
