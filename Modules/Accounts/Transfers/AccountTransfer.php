<?php

namespace Modules\Accounts\Transfers;

use Carbon\Carbon;
use App\Abstracts\DataTransferObjects;
use Illuminate\Foundation\Http\FormRequest;

class AccountTransfer extends DataTransferObjects
{
  /**
   * AccountTransfer constructor
   * @param int $id
   * @param string $name
   * @param string $type
   * @param string $email
   * @param string $phone
   * @param \Carbon\Carbon|string|null $phone_verified_at
   * @param \Carbon\Carbon|string|null $email_verified_at
   * @param string $password
   * @param \Carbon\Carbon|string|null $blocked_at
   */
  public function __construct(
    public int $id,
    public string $name,
    public string $type,
    public string $email,
    public string $phone,
    public Carbon|string|null $phone_verified_at,
    public Carbon|string|null $email_verified_at,
    public string $password,
    public Carbon|string|null $blocked_at,
  ) {
  }

  /**
   * Apply $request data to class properties
   * @param \Illuminate\Foundation\Http\FormRequest $request
   * @return AccountTransfer
   */
  public static function apply(FormRequest $request): static
  {
    $data = $request->validated();

    return new static(
      id: $data['id'],
      name: $data['name'],
      type: $data['type'],
      email: $data['email'],
      phone: $data['phone'],
      phone_verified_at: $data['phone_verified_at'],
      email_verified_at: $data['email_verified_at'],
      password: $data['password'],
      blocked_at: $data['password'],
    );
  }
}