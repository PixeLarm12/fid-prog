<?php

namespace App\Services;

use App\Repositories\TransactionRepository;

class TransactionService extends BaseService
{
	public function __construct(TransactionRepository $repository)
	{
		parent::__construct($repository);
	}
}