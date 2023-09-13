<?php

namespace App\BlogSite\Domain\Blog\Model\ValueObject;

final readonly class CommentUsername
{
    public function __construct(public string $value)
    {
    }
}
