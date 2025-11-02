<?php

namespace App\Http\Requests;

use App\Rules\CarNumberValidation;
use Illuminate\Foundation\Http\FormRequest;

/**
 * StoreRequest
 */
class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    /**
     * Rules
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'budget'      => 'required|numeric',
            'car_number'  => ['required', new CarNumberValidation()],
            'client_name' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required'  => 'User id is required',
            'country_id.exists' => 'Country number',
        ];
    }
}
