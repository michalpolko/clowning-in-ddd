<?php

namespace App\BlogSite\Domain\Blog\Model\ValueObject;

use Ramsey\Uuid\UuidInterface;

final readonly class RatingId
{
    public function __construct(public UuidInterface $value)
    {
    }
}
