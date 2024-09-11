<?php

namespace App\Http\Requests\Apis;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use App\Traits\ResponseJson ;

class InstractorRegesteration extends FormRequest
{
    use  ResponseJson ;
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
    public function rules(): array
    {
        return [

            'phone'              => ['required'] ,
            'phone2'              => ['sometimes'] ,
            'experience_certifications' =>['sometimes'] ,
            'teaching_fileds'    => ['required' ] ,
            'teaching_languages' => ['required' ] ,
            'linkedIn'           => ['required' ]
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new ValidationException( $validator , $this->sendError('Validation Error.', $validator->errors()->first()));
    }

}
