<?php

namespace App\BlogSite\Domain\Blog\Model\ValueObject;

final readonly class Ip4
{
    public function __construct(public string $value)
    {
    }
}
