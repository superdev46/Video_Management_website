<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VideoValidationRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'thumbnail' => 'mimes:jpeg,jpg,png|required',
            'path' => 'mimes:mp4,webm,ogg|required',

        ];
    }

    public function messages()
    {
    return [
         'thumbnail.required' => 'The Thumbnail of the video is required.',
         'path.required' => 'The Video field is required.',
    ];
    }
}
