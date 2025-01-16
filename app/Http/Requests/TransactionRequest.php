<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
			'user_id' => 'required|integer',
			'items' => 'required|array',
			'items.*.product_id' => 'required|integer',
			'items.*.amount' => 'required|integer',
			'items.*.unit_price' => 'required|numeric',
		];
    }

    public function messages() : array
	{
		return [
			'user_id.required' => 'User is required',
			'user_id.integer' => 'User must be integer',
			'items.array' => 'Items must be an array',
			'items.*.product_id.required' => 'Item product is required',
			'items.*.product_id.integer' => 'Item product must be an integer',
			'items.*.amount.required' => 'Item amount is required',
			'items.*.amount.integer' => 'Item amount must be an integer',
			'items.*.unit_price.required' => 'Item unit price is required',
			'items.*.unit_price.numeric' => 'Item unit price must be numeric'
		];
	}

    public function getData() : array
	{
		$items = $this->input('items');

		$totalTransaction = 0.0;
		foreach($items as $key => $item) {
			$totalPrice = (float) ($item['amount'] * $item['unit_price']);

			$items[$key]['total_price'] = $totalPrice;

			$totalTransaction += $totalPrice;
		}

		return [
			'user_id' => $this->input('user_id'),
			'total' => $totalTransaction,
			'date' => Carbon::now(),
			'items' => $items,
		];
	}
}
