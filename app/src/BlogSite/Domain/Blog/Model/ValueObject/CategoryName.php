<?php

namespace App\BlogSite\Domain\Blog\Model\ValueObject;

final readonly class CategoryName
{
    public function __construct(public string $value)
    {
    }
}
