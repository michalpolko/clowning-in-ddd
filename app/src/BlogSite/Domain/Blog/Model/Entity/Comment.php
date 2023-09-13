<?php

namespace App\BlogSite\Domain\Blog\Model\Entity;

use App\BlogSite\Domain\Blog\Model\ValueObject\CommentId;
use App\BlogSite\Domain\Blog\Model\ValueObject\CommentMessage;
use App\BlogSite\Domain\Blog\Model\ValueObject\CommentUsername;
use App\BlogSite\Domain\Blog\Model\ValueObject\Ip4;

final class Comment
{
    private CommentId $id;
    private CommentUsername $username;
    private CommentMessage $message;
    private \DateTimeImmutable $addedAt;
    private Ip4 $addedFromIp;

    public function __construct(
        CommentId $id,
        CommentUsername $username,
        CommentMessage $message,
        Ip4 $addedFromIp,
    ) {
        $this->id = $id;
        $this->username = $username;
        $this->message = $message;
        $this->addedFromIp = $addedFromIp;
        $this->addedAt = new \DateTimeImmutable();
    }

    public function getId(): CommentId
    {
        return $this->id;
    }
}
