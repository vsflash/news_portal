<?php

namespace App\Repository;

use App\Exception\EntityNotFoundException;

trait EnsureFoundTrait
{
    protected function ensureFound($entity, string $name): void
    {
        if (null === $entity) {
            throw new EntityNotFoundException($name);
        }
    }
}
