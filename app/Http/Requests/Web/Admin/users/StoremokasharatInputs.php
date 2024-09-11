<?php

namespace App\Http\Requests\Web\Admin\users;

use Illuminate\Foundation\Http\FormRequest;

class StoremokasharatInputs extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'type' => 'required', // Adjust the validation rules as needed
            'users' => 'required' ,
            'mokasher_id' =>'required',
            'ids' =>'required' ,
            'equation' => 'required'
        ];
    }
}
