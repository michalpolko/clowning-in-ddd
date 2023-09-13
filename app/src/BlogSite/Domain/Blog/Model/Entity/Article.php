<?php

namespace App\BlogSite\Domain\Blog\Model\Entity;

use App\BlogSite\Domain\Blog\Model\ValueObject\ArticleId;
use App\BlogSite\Domain\Blog\Model\ValueObject\CommentId;
use App\BlogSite\Domain\Blog\Model\ValueObject\CommentMessage;
use App\BlogSite\Domain\Blog\Model\ValueObject\CommentUsername;
use App\BlogSite\Domain\Blog\Model\ValueObject\Content;
use App\BlogSite\Domain\Blog\Model\ValueObject\Ip4;
use App\BlogSite\Domain\Blog\Model\ValueObject\RatingId;
use App\BlogSite\Domain\Blog\Model\ValueObject\RatingValue;
use App\BlogSite\Domain\Blog\Model\ValueObject\Title;
use App\Shared\Domain\Model\AggregateRoot;
use App\Shared\Domain\Model\AggregateRootTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class Article implements AggregateRoot
{
    use AggregateRootTrait;

    private ArticleId $id;
    private Title $title;
    private Content $content;
    private Category $category;
    /**
     * @var Collection<int, Rating>
     */
    private Collection $ratings;
    /**
     * @var Collection<int, Comment>
     */
    private Collection $comments;

    private function __construct()
    {
        $this->ratings = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    public function getId(): ArticleId
    {
        return $this->id;
    }

    public function getAggregateRootId(): UuidInterface
    {
        return $this->id->value;
    }

    public function getTitle(): Title
    {
        return $this->title;
    }

    public function getContent(): Content
    {
        return $this->content;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function rate(RatingValue $ratingValue, Ip4 $ip): Rating
    {
        $rating = new Rating(
            new RatingId(Uuid::uuid4()),
            $ratingValue,
            $ip,
        );

        $this->ratings->add($rating);

        return $rating;
    }

    public function comment(CommentMessage $message, CommentUsername $username, Ip4 $userIp): Comment
    {
        $comment = new Comment(
            new CommentId(Uuid::uuid4()),
            $username,
            $message,
            $userIp,
        );

        $this->comments->add($comment);

        return $comment;
    }
}
