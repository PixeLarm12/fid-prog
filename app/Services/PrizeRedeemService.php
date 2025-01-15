<?php

namespace App\Services;

use App\Repositories\PrizeRedeemRepository;

class PrizeRedeemService extends BaseService
{
	public function __construct(PrizeRedeemRepository $repository)
	{
		parent::__construct($repository);
	}
}