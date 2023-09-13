<?php

namespace App\Shared\Infrastructure\Serializer;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class UuidNormalizer implements NormalizerInterface, DenormalizerInterface
{
    public function normalize(mixed $object, string $format = null, array $context = [])
    {
        /* @var UuidInterface $object */
        return $object->toString();
    }

    public function supportsNormalization(mixed $data, string $format = null /* , array $context = [] */)
    {
        return $data instanceof UuidInterface;
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = [])
    {
        return Uuid::fromString($data);
    }

    public function supportsDenormalization(mixed $data, string $type, string $format = null /* , array $context = [] */)
    {
        return is_string($data) && is_a($type, UuidInterface::class, true) && Uuid::isValid($data);
    }
}
