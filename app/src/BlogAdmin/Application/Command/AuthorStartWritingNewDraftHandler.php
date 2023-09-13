<?php

namespace App\BlogAdmin\Application\Command;

use App\BlogAdmin\Domain\Blog\Model\Draft;
use App\BlogAdmin\Infrastructure\Repository\Blog\DraftRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class AuthorStartWritingNewDraftHandler
{
    public function __construct(private DraftRepository $draftRepository)
    {
    }

    public function __invoke(AuthorStartWritingNewDraftCommand $command)
    {
        $newDraft = Draft::authorStartsWritingNewDraft($command->authorId, $command->draftId);
        $this->draftRepository->save($newDraft);
    }
}
