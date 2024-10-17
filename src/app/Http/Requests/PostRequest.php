<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'post' => 'required|integer|min:1|max:5',
            'description' => 'nullable|string|max:400',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }
        public function messages()
    {
        return [
            'post.required' => '5段階評価をお願いします',
            'description.max' => '400字以内でお願いします',
            'image.max' => '画像データが大き過ぎます'
        ];
    }
}
