<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|min:4|unique:posts,title,' . $this->getPostId(),
            'content' => 'required|min:10',
            'description' => 'required|min:5',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
        ];
    }

    public function getPostId()
    {
        return $this->route('post');
    }
}
