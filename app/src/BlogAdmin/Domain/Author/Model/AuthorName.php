<?php

namespace App\BlogAdmin\Domain\Author\Model;

final readonly class AuthorName
{
    public function __construct(public string $value)
    {
    }
}
