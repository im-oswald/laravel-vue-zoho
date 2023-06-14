<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class AccountRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return true;
  }

  /**
   * Handle a failed validation attempt.
   *
   * @param  \Illuminate\Contracts\Validation\Validator  $validator
   * @return void
   *
   * @throws \Illuminate\Validation\ValidationException
   */
  protected function failedValidation(Validator $validator)
  {
    if ($this->expectsJson()) {
      throw new HttpResponseException(response()->json([
        'message' => 'Validation Error',
        'errors' => $validator->errors(),
      ], 422));
    }
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
   */
  public function rules(): array
  {
    return [
      'name' => 'string|required',
      'website' => 'url|required',
      'phone' => 'string|required|regex:/^(?:\+?\d{1,3})?[-. (]?\d{3}[-. )]?\d{3}[-. ]?\d{4}$/',
      'deal.name' => 'string|required',
      'deal.stage' => 'string|required',
    ];
  }

  /**
   * Get the error messages for the defined validation rules.
   *
   * @return array
   */
  public function messages()
  {
    return [
      'name.required' => 'The account name is required.',
      'website.required' => 'The account website is required.',
      'website.url' => 'The account website must be a valid URL.',
      'phone.required' => 'The account phone is required.',
      'phone.regex' => 'The account phone must be a valid phone number.',
      'deal.name.required' => 'The deal name is required.',
      'deal.stage.required' => 'The deal stage is required.',
    ];
  }
}
