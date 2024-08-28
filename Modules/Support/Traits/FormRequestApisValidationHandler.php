<?php

namespace Modules\Support\Traits;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

trait FormRequestApisValidationHandler
{
  use ApiTrait;

  /**
   * Api request validation handler
   * @param \Illuminate\Contracts\Validation\Validator $validator
   * @throws \Illuminate\Http\Exceptions\HttpResponseException
   * @return never
   */
  protected function failedValidation(Validator $validator)
  {
    $errors = $validator->errors();

    $response = $this->sendErrorData($errors->messages(), 'invalid data');

    throw new HttpResponseException($response);
  }
}