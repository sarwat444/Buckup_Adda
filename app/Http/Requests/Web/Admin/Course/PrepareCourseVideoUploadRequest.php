<?php

namespace App\Http\Requests\Web\Admin\Course;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PrepareCourseVideoUploadRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules():array
    {
        return [
            'video_name' => ['required', 'string','min:5','max:50'],
            'video_description' => ['required', 'string','min:5','max:200'],
            'folder_id' => ['required',Rule::exists('vimeo_folders','id')],
            'video' => ['required', 'mimes:mp4,mov,ogg,qt,webm,flv,avi,wmv,mpg,mpeg'],
        ];
    }
}
