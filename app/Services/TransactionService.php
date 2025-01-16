<?php

namespace App\Services;

use App\Repositories\TransactionRepository;
use Illuminate\Database\Eloquent\Model;

class TransactionService extends BaseService
{
	public function __construct(TransactionRepository $repository)
	{
		parent::__construct($repository);
	}

	public function saveRecord(array $data) : Model
	{
		$transaction = parent::saveRecord($data);

		$transaction->items()->createMany($data['items']);

		return $transaction;
	}
}