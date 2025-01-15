<?php

namespace App\Services;

use App\Repositories\TransactionItemRepository;

class TransactionItemService extends BaseService
{
	public function __construct(TransactionItemRepository $repository)
	{
		parent::__construct($repository);
	}
}