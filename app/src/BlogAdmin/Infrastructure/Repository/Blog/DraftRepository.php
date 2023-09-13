<?php

namespace App\BlogAdmin\Infrastructure\Repository\Blog;

use App\BlogAdmin\Domain\Blog\Model\Draft;
use App\BlogAdmin\Domain\Blog\Model\DraftId;
use App\Shared\Infrastructure\Repository\AggregateRootRepository;

final class DraftRepository extends AggregateRootRepository
{
    public function find(DraftId $draftId): ?Draft
    {
        return $this->load($draftId->value, Draft::class);
    }
}
