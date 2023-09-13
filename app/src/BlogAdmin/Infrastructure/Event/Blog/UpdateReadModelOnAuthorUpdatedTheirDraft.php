<?php

namespace App\BlogAdmin\Infrastructure\Event\Blog;

use App\BlogAdmin\Domain\Blog\Event\AuthorUpdatedTheirDraft;
use App\Infrastructure\Entity\Blog\Article;
use App\Infrastructure\Entity\Blog\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler(bus: 'event.bus')]
class UpdateReadModelOnAuthorUpdatedTheirDraft
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function __invoke(AuthorUpdatedTheirDraft $event)
    {
        /** @var Article $draft */
        $draft = $this->entityManager->getRepository(Article::class)->findOneByUuid($event->draftId->value);

        if (!$draft) {
            return;
        }

        $draft->title = $event->title->value;
        $draft->content = $event->content->value;
        $draft->category = $event->category
            ? $this->entityManager->find(Category::class, $event->category->getId()->value)
            : null;

        $this->entityManager->flush();
    }
}
