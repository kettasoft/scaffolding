<?php

namespace App\Abstracts;

use Arr;
use ArrayIterator;
use ReflectionClass;
use IteratorAggregate;
use Illuminate\Foundation\Http\FormRequest;
use App\Contracts\DataTransferObjects as Contract;

abstract class DataTransferObjects implements Contract, IteratorAggregate
{
  /**
   * Apply $request data to class properties
   * @param \Illuminate\Foundation\Http\FormRequest $request
   * @return static
   */
  abstract public static function apply(FormRequest $request): static;

  /**
   * Convert all properties of a class into an array
   * @param bool $forceIncludingPrivateProps
   * @return array
   */
  public function toArray(bool $forceIncludingPrivateProps = false): array
  {
    if ($forceIncludingPrivateProps) {
      return $this->forceIncludingPrivateProperties();
    }

    return get_object_vars($this);
  }

  /**
   * Get all properties except into keys
   * @param array|float|int|string $keys
   * @param bool $forceIncludingPrivateProps
   * @return array
   */
  public function except(array|float|int|string $keys, bool $forceIncludingPrivateProps = false): array
  {
    return Arr::except($this->toArray($forceIncludingPrivateProps), $keys);
  }

  /**
   * Get the only specific properties
   * @param array|string $keys
   * @param bool $forceIncludingPrivateProps
   * @return array
   */
  public function only(array|string $keys, bool $forceIncludingPrivateProps = false): array
  {
    return Arr::only($this->toArray($forceIncludingPrivateProps), $keys);
  }

  // Implement getIterator method
    public function getIterator(): ArrayIterator
    {
        $properties = get_object_vars($this);

        return new ArrayIterator($properties);
    }

  /**
   * Force including Private Properties
   * @return array
   */
  private function forceIncludingPrivateProperties(): array
  {
    // Use Reflection to get all properties
    $reflection = new ReflectionClass($this);
    $properties = $reflection->getProperties();

    // Convert properties to an associative array
    $result = [];
    foreach ($properties as $property) {
      // Make private properties accessible
      $property->setAccessible(true);
      $result[$property->getName()] = $property->getValue($this);
    }

    return $result;
  }
}