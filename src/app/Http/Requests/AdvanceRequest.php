<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdvanceRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名前の登録は必須です',
            'email.required' => 'メールアドレスは必須です',
            'email.email' => 'メールアドレスはメール形式で入力してください',
            'password.required' => 'パスワードの登録は必須です',
            'password.min' => 'パスワードは8桁以上で決めてください',
        ];
    }
}
