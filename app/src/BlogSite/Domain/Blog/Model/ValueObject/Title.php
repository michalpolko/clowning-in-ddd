<?php

namespace App\BlogSite\Domain\Blog\Model\ValueObject;

final readonly class Title
{
    public function __construct(public string $value)
    {
    }
}
