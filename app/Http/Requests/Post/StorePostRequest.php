<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePostRequest extends FormRequest
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
            'title' => [
                'required',
                'string',
                Rule::unique('posts', 'title')->ignore($this->route('post_id'))
            ],
            'content' => [
                'required',
                'min:20',
                'max:3000'
            ],
            'image' => [
                'nullable',
                'mimes:jpg,png,webp', 'max:2048',
                Rule::requiredIf(function () {
                    return !isset($this->post_id);
                })
            ],
        ];
    }
}
