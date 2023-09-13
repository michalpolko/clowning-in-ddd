<?php

namespace App\BlogAdmin\Domain\Blog\Model\ValueObject;

use Ramsey\Uuid\UuidInterface;

final readonly class AuthorId
{
    public function __construct(public UuidInterface $value)
    {
    }
}
