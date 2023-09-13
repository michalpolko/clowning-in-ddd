<?php

namespace App\BlogAdmin\Domain\Blog\Model\ValueObject;

use Ramsey\Uuid\UuidInterface;

final readonly class CategoryId
{
    public function __construct(public UuidInterface $value)
    {
    }
}
