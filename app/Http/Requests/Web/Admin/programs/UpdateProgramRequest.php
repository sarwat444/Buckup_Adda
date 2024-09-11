<?php

namespace App\Http\Requests\Web\Admin\programs;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProgramRequest extends FormRequest
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
            'program' => ['required', 'string', 'min:3', 'max:255'],
            'goal_id' => ['sometimes'] ,
            'addedBy' => ['sometimes'],
        ];
    }
}
