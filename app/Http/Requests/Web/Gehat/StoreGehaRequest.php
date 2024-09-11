<?php

namespace App\Http\Requests\Web\Gehat;

use Illuminate\Foundation\Http\FormRequest;

class StoreGehaRequest extends FormRequest
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
            'job_number'  => ['required'  , 'unique:users']  ,
            'password' => ['required'] ,
            'geha' => ['required']  ,
            'mangement_id' =>['required'] ,
            'is_manger' => ['sometimes']
        ];
    }
}
