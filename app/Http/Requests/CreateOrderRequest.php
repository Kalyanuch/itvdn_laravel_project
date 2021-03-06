<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
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
        return [
            'customerName' => 'required|string|max:150',
            'customerLastName' => 'string|max:150',
            'customerEmail' => 'required|email',
            'customerPhone' => 'required|string',
            'customerAddress' => 'string',
            'customerComment' => 'nullable|string',
            'updateUser' => 'boolean',
        ];
    }
}
