<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrizeRedeemRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'prize_id' => 'required|integer',
            'user_id' => 'required|integer',
            'date' => 'required|datetime',
            'redeemed' => 'required|min:3|max:70',
		];
    }

    public function messages() : array
	{
		return [
			'prize_id.required' => 'Prize is required',
			'prize_id.integer' => 'Prize must be integer',
			'user_id.required' => 'User is required',
			'user_id.integer' => 'User must be integer',
			'date.required' => 'Date is required',
			'date.integer' => 'Date must be datetime',
			'redeemed.required' => 'Redeemed is required',
			'redeemed.min' => 'Redeemed must have at least 3 characters',
			'redeemed.max' => 'Redeemed cannot be longer than 70 characters',
		];
	}

    public function getData() : array
	{
		return [
			'prize_id' => $this->input('prize_id'),
			'user_id' => $this->input('user_id'),
			'date' => $this->input('date'),
			'redeemed' => $this->input('redeemed'),
		];
	}
}
