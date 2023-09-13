<?php

namespace App\BlogAdmin\Domain\Repository\Blog;

use App\BlogAdmin\Domain\Blog\Model\Entity\Draft;
use App\BlogAdmin\Domain\Blog\Model\ValueObject\DraftId;

interface DraftRepositoryInterface
{
    public function find(DraftId $draftId): ?Draft;

    public function save(Draft $draft): void;
}
