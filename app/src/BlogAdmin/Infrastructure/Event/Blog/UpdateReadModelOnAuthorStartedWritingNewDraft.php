<?php

namespace App\BlogAdmin\Infrastructure\Event\Blog;

use App\BlogAdmin\Domain\Blog\Event\AuthorStartedWritingNewDraft;
use App\Infrastructure\Entity\Blog\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler(bus: 'event.bus')]
class UpdateReadModelOnAuthorStartedWritingNewDraft
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function __invoke(AuthorStartedWritingNewDraft $event)
    {
        $draft = new Article(
            $event->draftId->value,
            '',
            '',
            null,
            true
        );
        $this->entityManager->persist($draft);
        $this->entityManager->flush();
    }
}
