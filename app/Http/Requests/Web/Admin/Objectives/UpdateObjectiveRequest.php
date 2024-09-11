<?php

namespace App\Http\Requests\Web\Admin\Objectives;

use Illuminate\Foundation\Http\FormRequest;

class UpdateObjectiveRequest extends FormRequest
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

            'objective' => ['required', 'string', 'min:3', 'max:255'],
            'kheta_id' =>['required']
        ];
    }
}
