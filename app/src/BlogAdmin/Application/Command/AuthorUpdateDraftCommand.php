<?php

namespace App\BlogAdmin\Application\Command;

use App\BlogAdmin\Domain\Blog\Model\ValueObject\CategoryId;
use App\BlogAdmin\Domain\Blog\Model\ValueObject\Content;
use App\BlogAdmin\Domain\Blog\Model\ValueObject\DraftId;
use App\BlogAdmin\Domain\Blog\Model\ValueObject\Title;

readonly class AuthorUpdateDraftCommand
{
    public function __construct(
        public DraftId $draftId,
        public Title $title,
        public Content $content,
        public ?CategoryId $categoryId,
    ) {
    }
}
