<?php

namespace App\BlogAdmin\Domain\Blog\Model\ValueObject;

final readonly class CategoryName
{
    public function __construct(public string $value)
    {
    }
}
