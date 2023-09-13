<?php

namespace App\BlogAdmin\Application\Command;

use App\BlogAdmin\Infrastructure\Repository\Blog\DraftRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class AuthorUpdateDraftHandler
{
    public function __construct(private DraftRepository $draftRepository)
    {
    }

    public function __invoke(AuthorUpdateDraftCommand $command)
    {
        $draft = $this->draftRepository->find($command->draftId);

        if (!$draft) {
            throw new \Exception('Draft does not exist');
        }

        $draft->authorUpdatesTheirDraft(
            $command->title,
            $command->content,
            $command->categoryId,
        );

        $this->draftRepository->save($draft);
    }
}
