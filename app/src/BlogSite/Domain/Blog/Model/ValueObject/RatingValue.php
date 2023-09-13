<?php

namespace App\BlogSite\Domain\Blog\Model\ValueObject;

final readonly class RatingValue
{
    public function __construct(public int $value)
    {
        if ($value < 1 || $value > 5) {
            throw new \LogicException('Invalid rating value '.$value);
        }
    }
}
