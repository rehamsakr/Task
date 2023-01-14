<?php

namespace App\Http\Requests\Comment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCommentRequest extends FormRequest
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
            'post_id' => [
                'required',
                'integer',
                Rule::exists('posts', 'id')
            ],
            'user_id' => [
                'required',
                'integer',
                Rule::exists('users', 'id')
            ],
            'comment' => [
                'required',
                'string',
                'min:3',
                'max:800',
            ]
        ];
    }
}
