<?php

namespace App\Contracts;

use Illuminate\Foundation\Http\FormRequest;

interface DataTransferObjects
{
  /**
   * Apply $request data to class properties
   * @param \Illuminate\Foundation\Http\FormRequest $request
   * @return static
   */
  public static function apply(FormRequest $request): static;

  /**
   * Convert all properties of a class into an array
   * @param bool $forceIncludingPrivateProps
   * @return array
   */
  public function toArray(bool $forceIncludingPrivateProps): array;

  /**
   * Get all properties except into keys
   * @param array|float|int|string $keys
   * @param bool $forceIncludingPrivateProps
   * @return array
   */
  public function except(array|float|int|string $keys, bool $forceIncludingPrivateProps = false): array;

  /**
   * Get the only specific properties
   * @param array|string $keys
   * @param bool $forceIncludingPrivateProps
   * @return array
   */
  public function only(array|string $keys, bool $forceIncludingPrivateProps = false): array;
}