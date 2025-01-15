<?php

namespace App\Repositories;

use App\Models\Prize;

class PrizeRepository extends BaseRepository
{
	public function __construct(Prize $model)
	{
		parent::__construct($model);
	}
}