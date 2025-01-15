<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
			'title'                 => 'required|min:3|max:70',
			'price'                => 'required|decimal',
		];
    }

    public function messages() : array
	{
		return [
			'title.required'                 => 'Title is required',
			'title.min'                      => 'Title must have at least 3 characters',
			'title.max'                      => 'Title cannot be longer than 70 characters',
			'price.required'                 => 'Price is required',
			'price.decimal'                 => 'Price must be decimal',
		];
	}

    public function getData() : array
	{
		return [
			'title'                 => $this->input('title'),
			'price'                => $this->input('price'),
		];
	}
}
