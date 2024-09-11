<?php

namespace App\Http\Requests\Apis;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Http\FormRequest;
use App\Traits\ResponseJson;
class UserRegister extends FormRequest

{
    use  ResponseJson;

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
            'first_name' => ['required','max:50'],
            'last_name' => ['required','max:50'],
            'password' => ['required', 'string','max:20'],
            'email' => ['required', 'email','max:50' , 'unique:users']
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new ValidationException( $validator , $this->sendError('Validation Error.', $validator->errors()->first()));
    }

}
