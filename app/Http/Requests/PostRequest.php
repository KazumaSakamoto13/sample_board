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
        
                'title' => 'required|max:255',
                'content' => 'required',
                'user_id' => 'required|numeric',
                'category_id' => 'required|numeric',
                'image' => 'required|file|image|mimes:jpeg,png,jpg,gif|max:2048'
            ];
        
    }

    public function attributes()
{
    return [
        'title' => 'タイトル',
        'content' => '本文',
        'category_id' => 'カテゴリー',
        'image' => '写真',

    ];
}
}

