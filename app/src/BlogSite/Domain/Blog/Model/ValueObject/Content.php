<?php

namespace App\BlogSite\Domain\Blog\Model\ValueObject;

final readonly class Content
{
    public function __construct(public string $value)
    {
    }
}
