<?php

namespace App\BlogAdmin\UserInterface\Cli\Command;

use App\BlogAdmin\Application\Command\AuthorUpdateDraftCommand;
use App\BlogAdmin\Domain\Blog\Model\Content;
use App\BlogAdmin\Domain\Blog\Model\DraftId;
use App\BlogAdmin\Domain\Blog\Model\Title;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsCommand(name: 'admin-panel:blog:update-draft')]
class UpdateDraftCommand extends Command
{
    public function __construct(
        private MessageBusInterface $commandBus,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $draftUuidString = $io->ask('Draft ID');
        $title = $io->ask('Title');
        $content = $io->ask('Content');

        $draftUuid = Uuid::fromString($draftUuidString);

        $io->info('Updating draft with ID '.$draftUuid->toString());

        $draftId = new DraftId($draftUuid);

        $this->commandBus->dispatch(new AuthorUpdateDraftCommand(
            $draftId,
            new Title($title),
            new Content($content),
            null,
        ));

        return 0;
    }
}
