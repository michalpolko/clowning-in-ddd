<?php

namespace App\Shared\Infrastructure\Repository;

use App\Shared\Domain\Model\AggregateRoot;
use App\Shared\Domain\Model\DomainEvent;
use App\Shared\Infrastructure\Entity\DomainEvent as DomainEventEntity;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Serializer\SerializerInterface;

abstract class AggregateRootRepository
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private MessageBusInterface $eventBus,
        private SerializerInterface $serializer,
    ) {
    }

    public function save(AggregateRoot $aggregateRoot): void
    {
        /** @var DomainEvent $domainEvent */
        foreach ($aggregateRoot->getEmittedEvents() as $domainEvent) {
            $storedDomainEvent = new DomainEventEntity(
                $domainEvent->getEventId(),
                $domainEvent::class,
                $aggregateRoot->getAggregateRootId(),
                $aggregateRoot::class,
                $this->serializer->serialize($domainEvent, 'json'),
                $domainEvent->getVersion(),
            );
            $this->entityManager->persist($storedDomainEvent);
            $this->eventBus->dispatch($domainEvent);
        }

        $this->entityManager->flush();
    }

    protected function load(UuidInterface $aggregateRootId, string $aggregateRootFqcn): ?AggregateRoot
    {
        /** @var DomainEventEntity[] $storedDomainEvents */
        $storedDomainEvents = $this->entityManager->createQueryBuilder()
            ->select('de')
            ->from(DomainEventEntity::class, 'de')
            ->andWhere('de.aggregateRootFqcn = :aggregateRootFqcn')
            ->setParameter('aggregateRootFqcn', $aggregateRootFqcn)
            ->andWhere('de.aggregateRootId = :aggregateRootId')
            ->setParameter('aggregateRootId', $aggregateRootId)
            ->orderBy('de.version', 'asc')
            ->getQuery()
            ->getResult();

        if (empty($storedDomainEvents)) {
            return null;
        }

        $domainEventsHistory = [];

        foreach ($storedDomainEvents as $storedDomainEvent) {
            $domainEventsHistory[] = $this->serializer->deserialize(
                $storedDomainEvent->eventData,
                $storedDomainEvent->eventFqcn,
                'json'
            );
        }

        // instantiate aggregate root via reflection
        $aggregateRootClass = new \ReflectionClass($storedDomainEvent->aggregateRootFqcn);
        /** @var AggregateRoot $aggregateRoot */
        $aggregateRoot = $aggregateRootClass->newInstanceWithoutConstructor();
        $aggregateRoot->loadFromEvents($domainEventsHistory);

        return $aggregateRoot;
    }
}
