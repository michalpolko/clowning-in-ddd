<?php

namespace App\BlogAdmin\Application\Command;

use App\BlogAdmin\Domain\Blog\Model\Entity\Draft;
use App\BlogAdmin\Domain\Repository\Blog\DraftRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class AuthorStartWritingNewDraftHandler
{
    public function __construct(private DraftRepositoryInterface $draftRepository)
    {
    }

    public function __invoke(AuthorStartWritingNewDraftCommand $command)
    {
        $newDraft = Draft::authorStartsWritingNewDraft($command->authorId, $command->draftId);
        $this->draftRepository->save($newDraft);
    }
}
