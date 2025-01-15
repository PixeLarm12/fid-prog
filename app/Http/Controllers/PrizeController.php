<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrizeRequest;
use App\Services\PrizeService;
use Symfony\Component\HttpFoundation\Response;

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

	public function store(PrizeRequest $request)
	{
		return $this->defaultResponse($this->service->saveRecord($request->getData()), Response::HTTP_CREATED);
	}

	public function show(string $id)
	{
		return $this->defaultResponse($this->service->findRecord($id));
	}

	public function update(PrizeRequest $request, string $id)
	{
		return $this->defaultResponse($this->service->updateRecord($id, $request->getData()), Response::HTTP_CREATED);
	}
}
