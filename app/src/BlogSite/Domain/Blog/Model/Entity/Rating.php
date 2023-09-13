<?php

namespace App\BlogSite\Domain\Blog\Model\Entity;

use App\BlogSite\Domain\Blog\Model\ValueObject\Ip4;
use App\BlogSite\Domain\Blog\Model\ValueObject\RatingId;
use App\BlogSite\Domain\Blog\Model\ValueObject\RatingValue;

final class Rating
{
    private RatingId $id;
    private RatingValue $value;
    private \DateTimeImmutable $addedAt;
    private Ip4 $addedFromIp;

    public function __construct(
        RatingId $id,
        RatingValue $value,
        Ip4 $addedFromIp,
    ) {
        $this->id = $id;
        $this->value = $value;
        $this->addedFromIp = $addedFromIp;
        $this->addedAt = new \DateTimeImmutable();
    }

    public function getId(): RatingId
    {
        return $this->id;
    }
}
