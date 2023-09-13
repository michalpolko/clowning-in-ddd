<?php

namespace App\Shared\Domain\Model;

use Ramsey\Uuid\UuidInterface;

abstract class DomainEvent
{
    protected UuidInterface $eventId;
    protected int $version;

    public function getEventId(): UuidInterface
    {
        return $this->eventId;
    }

    public function getVersion(): int
    {
        return $this->version;
    }

    public function setVersion(int $newVersion): void
    {
        $this->version = $newVersion;
    }
}
