<?php

namespace Modules\Accounts\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ParentRequest extends FormRequest
{
    use WithHashedPassword;

    /**
     * Determine if the supervisor is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->isMethod('POST')) {
            return $this->createRules();
        } else {
            return $this->updateRules();
        }
    }

    /**
     * Get the create validation rules that apply to the request.
     *
     * @return array
     */
    public function createRules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'unique:users'],
            'phone' => ['required', 'unique:users,phone'],
            'password' => ['required', 'min:8', 'confirmed'],
            'type' => ['sometimes', 'nullable', Rule::in(array_keys(trans('accounts::users.types')))],
        ];
    }

    /**
     * Get the update validation rules that apply to the request.
     *
     * @return array
     */
    public function updateRules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'unique:users,email,' . $this->route('parent')->id],
            'phone' => ['required', 'unique:users,phone,' . $this->route('parent')->id],
            'password' => ['nullable', 'min:8', 'confirmed'],
            'type' => ['sometimes', 'nullable', Rule::in(array_keys(trans('accounts::users.types')))],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return trans('accounts::parents.attributes');
    }
}
