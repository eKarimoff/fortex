<?php

namespace App\Http\Requests;

use App\Rules\CarNumberValidation;
use Illuminate\Foundation\Http\FormRequest;

/**
 * StoreRequest
 */
class StoreRequest extends FormRequest
{
    /**
     * @return bool
     */
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
            'user_id'     => 'required|exists:users,id',
            'budget'      => 'required|numeric',
            'car_number'  => ['required',new CarNumberValidation(), 'unique:insurances,car_number'],
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
