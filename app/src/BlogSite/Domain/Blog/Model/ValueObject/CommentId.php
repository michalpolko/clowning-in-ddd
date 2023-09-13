<?php

namespace App\BlogSite\Domain\Blog\Model\ValueObject;

use Ramsey\Uuid\UuidInterface;

final readonly class CommentId
{
    public function __construct(public UuidInterface $value)
    {
    }
}
