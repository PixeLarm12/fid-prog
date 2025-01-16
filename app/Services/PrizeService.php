<?php

namespace App\Services;

use App\Models\Prize;
use App\Repositories\PrizeRepository;

class PrizeService extends BaseService
{
	public function __construct()
	{
		parent::__construct(new PrizeRepository(new Prize()));
	}
}