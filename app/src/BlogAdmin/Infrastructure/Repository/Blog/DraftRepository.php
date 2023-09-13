<?php

namespace App\BlogAdmin\Infrastructure\Repository\Blog;

use App\BlogAdmin\Domain\Blog\Model\Entity\Draft;
use App\BlogAdmin\Domain\Blog\Model\ValueObject\DraftId;
use App\BlogAdmin\Domain\Repository\Blog\DraftRepositoryInterface;
use App\Shared\Infrastructure\Repository\AggregateRootRepository;

final class DraftRepository extends AggregateRootRepository implements DraftRepositoryInterface
{
    public function find(DraftId $draftId): ?Draft
    {
        return $this->load($draftId->value, Draft::class);
    }
}
