<?php

namespace Core\Model;

use Laminas\Hydrator\ReflectionHydrator;

trait CoreModelTrait
{
  public function exchangeArray(array $data): void
  {
    $reflectionHydrator = new ReflectionHydrator();
    $reflectionHydrator->hydrate($data, $this);
  }

  public function getArrayCopy(): array
  {
    $reflectionHydrator = new ReflectionHydrator();

    return $reflectionHydrator->extract($this);
  }
}