<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AuthorRequest extends FormRequest
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
        if ($this->getMethod() == 'POST') {
            return [
                'name' => 'required|max:100',
                'biography' => 'required'
            ];
        }

        if ($this->getMethod() == 'GET') {
            return [
                'sort_by' => 'in:desc,asc'
            ];
        }

        $author = $this->route('author');
        return [
            'name' => [
                'required',
                Rule::unique('authors')->ignore($author->id)
            ],
            'biography' => 'required',
        ];
    }
}
