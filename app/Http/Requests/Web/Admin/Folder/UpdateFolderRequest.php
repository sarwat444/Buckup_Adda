<?php

namespace App\Http\Requests\Web\Admin\Folder;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFolderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:50', Rule::unique('vimeo_folders', 'name')->ignore($this->route('vimeo_folder')->id)],
        ];
    }
}
