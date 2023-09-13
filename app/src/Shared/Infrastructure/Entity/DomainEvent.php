<?php

namespace App\Shared\Infrastructure\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Index;
use Doctrine\ORM\Mapping\Table;
use Ramsey\Uuid\UuidInterface;

#[Entity()]
#[Table(name: 'domain_event')]
#[Index(
    fields: ['aggregateRootFqcn', 'aggregateRootId'],
    name: 'idx_domain_event_aggregate_root_fqcn_id'
)]
class DomainEvent
{
    public function __construct(
        #[Id]
        #[Column(type: 'uuid')]
        public UuidInterface $uuid,
        #[Column]
        public string $eventFqcn,
        #[Column(type: 'uuid')]
        public UuidInterface $aggregateRootId,
        #[Column]
        public string $aggregateRootFqcn,
        #[Column(type: 'json')]
        public string $eventData,
        #[Column(options: ['unsigned' => true])]
        public int $version,
    ) {
    }
}
