<?php

namespace App\Http\Requests\Web\Admin\mokashers;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMokasherRequest extends FormRequest
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
    public function rules()
    {
        return [
            'id'=>['required'],
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'type' => ['sometimes'],
            'program_id' => ['sometimes'] ,
            'addedBy' => ['sometimes']
        ];
    }
}
