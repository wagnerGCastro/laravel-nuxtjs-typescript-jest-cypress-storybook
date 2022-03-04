<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Post;

class PostStoreUpdate extends FormRequest
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
    public function rules(Post $post)
    {
        return [
            'user_id' => 'required|exists:users,id',
            'title' => 'required|min:3|max:255',
            'description' => 'required|min:3',
            'status' => [
                'required',
                Rule::in(array_keys($post->statusOptions))
            ],
        ];
    }
}
