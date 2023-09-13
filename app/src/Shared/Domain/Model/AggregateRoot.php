<?php

namespace App\Shared\Domain\Model;

use Ramsey\Uuid\UuidInterface;

interface AggregateRoot
{
    public function getAggregateRootId(): UuidInterface;

    /**
     * @return DomainEvent[]
     */
    public function getEmittedEvents(): array;

    /**
     * @param DomainEvent[] $domainEvents
     */
    public function loadFromEvents(array $domainEvents): void;

    public function getVersion(): int;
}
