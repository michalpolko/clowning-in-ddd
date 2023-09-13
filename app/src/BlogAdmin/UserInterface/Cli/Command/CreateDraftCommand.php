<?php

namespace App\BlogAdmin\UserInterface\Cli\Command;

use App\BlogAdmin\Application\Command\AuthorStartWritingNewDraftCommand;
use App\BlogAdmin\Domain\Blog\Model\AuthorId;
use App\BlogAdmin\Domain\Blog\Model\DraftId;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsCommand(name: 'admin-panel:blog:create-draft')]
class CreateDraftCommand extends Command
{
    public function __construct(
        private MessageBusInterface $commandBus,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $draftUuid = Uuid::uuid4();

        $io->info('Creating new draft with ID '.$draftUuid->toString());

        $draftId = new DraftId($draftUuid);
        $authorId = new AuthorId(Uuid::uuid4());

        $this->commandBus->dispatch(new AuthorStartWritingNewDraftCommand(
            $authorId,
            $draftId,
        ));

        return 0;
    }
}
