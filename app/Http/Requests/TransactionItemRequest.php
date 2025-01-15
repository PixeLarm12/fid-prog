<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionItemRequest extends FormRequest
{
    public function rules(): array
    {
        return [
			'transaction_id'                 => 'required|integer',
			'product_id'                 => 'required|integer',
			'unit_price'                 => 'required|decimal',
			'amount'                => 'required|integer',
			'total_price'                 => 'required|decimal',
		];
    }

    public function messages() : array
	{
		return [
			'transaction_id.required'                 => 'Transaction is required',
			'transaction_id.integer'                 => 'Transaction must be integer',
			'product_id.required'                 => 'Product is required',
			'product_id.integer'                 => 'Product must be integer',
			'unit_price.required'                 => 'Unit price is required',
			'unit_price.decimal'                 => 'Unit price must be decimal',
			'amount.required'                 => 'Amount is required',
			'amount.integer'                 => 'Amount must be integer',
			'total_price.required'                 => 'Total price is required',
			'total_price.decimal'                 => 'Total price must be integer',
		];
	}

    public function getData() : array
	{
		return [
			'transaction_id'                 => $this->input('transaction_id'),
			'product_id'                 => $this->input('product_id'),
			'unit_price'                 => $this->input('unit_price'),
			'amount'                 => $this->input('amount'),
			'total_price'                 => $this->input('total_price'),
		];
	}
}
