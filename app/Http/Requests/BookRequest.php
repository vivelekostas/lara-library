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
//    public function rules()
//    {
//        return [
//            'name' => 'required|unique:books,name',
//            'pages' => 'required',
//            'creator_id' => 'required'
//        ];
//    }
    public function rules()
    {
        if ($this->getMethod() == 'POST') {
            return [
                'name' => 'required|unique:books,name',
                'pages' => 'required',
                'creator_id' => 'required'
            ];
        }

//        dd('olololo');
//        dd($this->route('book'));
        $book = $this->route('book');
        return [
            'name' => [
                'required',
                Rule::unique('books')->ignore($book->id)
            ],
            'pages' => 'required',
            'creator_id' => 'required'
        ];
    }
}
