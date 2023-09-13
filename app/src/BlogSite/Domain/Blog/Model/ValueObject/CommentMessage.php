<?php

namespace App\BlogSite\Domain\Blog\Model\ValueObject;

final readonly class CommentMessage
{
    public function __construct(public string $value)
    {
    }
}
