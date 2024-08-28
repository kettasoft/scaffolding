<?php

namespace Modules\Accounts\Transfers;
use App\Abstracts\DataTransferObjects;
use Illuminate\Foundation\Http\FormRequest;

class CreateAdminTransfer extends DataTransferObjects
{
  public function __construct(
    public string $name,
    public string $email,
    public string $phone,
    public string $preferred_locale,
    public int $role_id,
    public string $password
  )
  {}

  /**
   * Apply $request data to class properties
   * @param \Illuminate\Foundation\Http\FormRequest $request
   * @return AccountTransfer
   */
  public static function apply(FormRequest $request): static
  {
    $data = $request->allWithHashedPassword();

    return new static(
      name: $data['name'],
      email: $data['email'],
      phone: $data['phone'],
      preferred_locale: $data['preferred_locale'],
      password: $data['password'],
      role_id: $data['role_id'],
    );
  }
}