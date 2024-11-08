<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'store_name' => 'required|string|max:30',
            'explanation' => 'required|string|max:200',
        ];
    }

    public function messages()
    {
        return [
            'image.required' => '店舗イメージ画像は必須です',
            'image.mimes' => '非対応の拡張子です。',
            'image.max' => '画像データが大き過ぎます',
            'store_name.required' => '店舗名は必須です',
            'store_name.max' => '店舗名は30文字以内です。',
            'explanation.required' => '店舗の紹介文は必須です。',
            'explanation.max' => '店舗の紹介文は200文字以内です。',
        ];
    }
}
