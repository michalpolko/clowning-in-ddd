<?php

namespace App\BlogAdmin\Domain\Author\Model;

use Ramsey\Uuid\UuidInterface;

final readonly class AuthorId
{
    public function __construct(public UuidInterface $value)
    {
    }
}
