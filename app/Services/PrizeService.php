<?php

namespace App\Services;

use App\Repositories\PrizeRepository;

class PrizeService extends BaseService
{
	public function __construct(PrizeRepository $repository)
	{
		parent::__construct($repository);
	}
}