<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrizeRedeemRequest;
use App\Services\PrizeRedeemService;
use Symfony\Component\HttpFoundation\Response;

class PrizeRedeemController extends BaseController
{
    public function __construct(PrizeRedeemService $service)
	{
		parent::__construct($service);
	}

	public function store(PrizeRedeemRequest $request)
	{
		return $this->defaultResponse($this->service->saveRecord($request->getData()), Response::HTTP_CREATED);
	}
}
