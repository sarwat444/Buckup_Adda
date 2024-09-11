<?php

namespace App\Http\Requests\Web\admin\kheta;

use Illuminate\Foundation\Http\FormRequest;

class StoreKhetaRequest extends FormRequest
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
            'name' => ['required' , 'min:3','max:400'],
            'years' => ['sometimes'] ,
            'image' => ['sometimes']
        ];
    }
}
