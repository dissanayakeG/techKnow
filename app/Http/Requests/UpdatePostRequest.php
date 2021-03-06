<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            'tag' => ['required'],
            'topic' => ['required', 'string'],
            'post_content' => ['required', 'string'], 
        ];
    }

    public function messages()
    {
        $messages = [
            'tag.required' => 'Tag is required.',
            'topic.required' => 'Topic is required.',
            'content.required' => 'Content is required.',
        ];
        return $messages;

    }
}
