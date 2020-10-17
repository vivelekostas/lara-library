<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookRequest extends FormRequest
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
                'title' => 'required|unique:books,title',
                'pages' => 'required',
                'creator_id' => 'required'
            ];
        }

        $book = $this->route('book');
        return [
            'title' => [
                'required',
                Rule::unique('books')->ignore($book->id)
            ],
            'pages' => 'required',
            'creator_id' => 'required'
        ];
    }
}
