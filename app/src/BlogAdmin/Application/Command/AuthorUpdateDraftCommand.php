<?php

namespace App\BlogAdmin\Application\Command;

use App\BlogAdmin\Domain\Blog\Model\Category;
use App\BlogAdmin\Domain\Blog\Model\Content;
use App\BlogAdmin\Domain\Blog\Model\DraftId;
use App\BlogAdmin\Domain\Blog\Model\Title;

readonly class AuthorUpdateDraftCommand
{
    public function __construct(
        public DraftId $draftId,
        public Title $title,
        public Content $content,
        public ?Category $category,
    ) {
    }
}
