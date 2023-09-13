<?php

namespace App\Shared\Domain\Model;

trait AggregateRootTrait
{
    /**
     * @var DomainEvent[]
     */
    protected array $emittedEvents = [];

    /**
     * Current version of the aggregate. Each emitted domain event increases it by 1.
     */
    protected int $version = 0;

    protected function emit(DomainEvent $domainEvent): void
    {
        $domainEvent->setVersion(++$this->version);
        $this->emittedEvents[] = $domainEvent;
    }

    /**
     * @return DomainEvent[]
     */
    public function getEmittedEvents(): array
    {
        return $this->emittedEvents;
    }

    /**
     * @param DomainEvent[] $domainEvents
     */
    public function loadFromEvents(array $domainEvents): void
    {
        foreach ($domainEvents as $domainEvent) {
            if ($domainEvent->getVersion() !== ($this->version + 1)) {
                throw new \Exception(sprintf('Invalid domain event version %s. Expected %d but got %d.', $domainEvent::class, $this->version + 1, $domainEvent->getVersion()));
            }

            $this->apply($domainEvent);
            $this->version = $domainEvent->getVersion();
        }
    }

    protected function applyAndEmit(DomainEvent $domainEvent): void
    {
        $this->apply($domainEvent);
        $this->emit($domainEvent);
    }

    public function getVersion(): int
    {
        return $this->version;
    }
}
