<?php

namespace App\Http\Controllers;

use App\Services\PrizeService;

class PrizeController extends BaseController
{
    public function __construct(PrizeService $service)
	{
		parent::__construct($service);
	}

	public function index()
	{
		return $this->defaultResponse($this->service->getAllRecords());
	}
}
