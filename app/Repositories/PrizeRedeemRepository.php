<?php

namespace App\Repositories;

use App\Models\PrizeRedeem;

class PrizeRedeemRepository extends BaseRepository
{
	public function __construct(PrizeRedeem $model)
	{
		parent::__construct($model);
	}
}