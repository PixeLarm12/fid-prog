<?php

namespace App\Repositories;

use App\Models\TransactionItem;

class TransactionItemRepository extends BaseRepository
{
	public function __construct(TransactionItem $model)
	{
		parent::__construct($model);
	}
}