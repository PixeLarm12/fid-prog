<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrizeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
			'title'                 => 'required|min:3|max:70',
			'points'                => 'required|integer',
		];
    }

    public function messages() : array
	{
		return [
			'title.required'                 => 'Title is required',
			'title.min'                      => 'Title must have at least 3 characters',
			'title.max'                      => 'Title cannot be longer than 70 characters',
			'points.required'                 => 'Points is required',
			'points.integer'                 => 'Points must be integer',
		];
	}

    public function getData() : array
	{
		return [
			'title'                 => $this->input('title'),
			'points'                => $this->input('points'),
		];
	}
}
