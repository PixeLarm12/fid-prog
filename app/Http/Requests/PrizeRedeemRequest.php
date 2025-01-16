<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class PrizeRedeemRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'prize_id' => 'required|integer',
            'user_id' => 'required|integer',
		];
    }

    public function messages() : array
	{
		return [
			'prize_id.required' => 'Prize is required',
			'prize_id.integer' => 'Prize must be integer',
			'user_id.required' => 'User is required',
			'user_id.integer' => 'User must be integer',
		];
	}

    public function getData() : array
	{
		return [
			'prize_id' => $this->input('prize_id'),
			'user_id' => $this->input('user_id'),
			'date' => Carbon::now(),
		];
	}
}
