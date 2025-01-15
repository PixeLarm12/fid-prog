<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
			'user_id'                 => 'required|integer',
			'total'                => 'required|decimal',
			'date'                => 'required|datetime',
		];
    }

    public function messages() : array
	{
		return [
			'user_id.required'                 => 'User is required',
			'user_id.integer'                 => 'User must be integer',
			'total.required'                 => 'Total is required',
			'total.decimal'                 => 'Total must be decimal',
			'date.datetime'                 => 'Date must be datetime',
		];
	}

    public function getData() : array
	{
		return [
			'user_id'                 => $this->input('user_id'),
			'total'                => $this->input('total'),
			'date'                => $this->input('date'),
		];
	}
}
