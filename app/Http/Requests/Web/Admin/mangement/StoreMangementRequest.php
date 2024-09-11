<?php

namespace App\Http\Requests\Web\Admin\mangement;

use Illuminate\Foundation\Http\FormRequest;

class StoreMangementRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:3', 'max:900'] ,
            'top_mangement' => ['sometimes'] ,
            'kheta_id' =>['required']
        ];
    }
}
