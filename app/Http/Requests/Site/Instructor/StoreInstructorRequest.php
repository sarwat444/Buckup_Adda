<?php

namespace App\Http\Requests\Site\Instructor;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use App\Traits\ResponseJson ;

class StoreInstructorRequest extends FormRequest
{
    use ResponseJson ;
    
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'message' => ['required', 'string', 'max:500'],
            'attachment' => ['required', 'file', 'mimes:pdf,doc,docx', 'max:2000']
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new ValidationException( $validator , $this->sendError('Validation Error.', $validator->errors()->first()));
    }
}
