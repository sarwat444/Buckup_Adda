<?php

namespace App\Http\Requests\Apis;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class SaveBankDetails extends FormRequest
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
            'account_name'   => ['required'] ,
            'bank_country'      => ['required' ] ,
            'account_number'            => ['required' ] ,
            'account_iban'       => ['required' ] ,
            'swift_code'           => ['required' ] ,
            'bank_name'   => ['required' ]
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new ValidationException( $validator , $this->sendError('Validation Error.', $validator->errors()->first()));
    }
}
