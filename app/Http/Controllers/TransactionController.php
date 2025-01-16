<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TransactionController extends BaseController
{
    public function __construct(TransactionService $service)
	{
		parent::__construct($service);
	}

	public function index()
	{
		return $this->defaultResponse($this->service->getAllRecords());
	}

	public function store(TransactionRequest $request)
	{
		return $this->defaultResponse($this->service->saveRecord($request->getData()), Response::HTTP_CREATED);
	}

	public function metrics(Request $request)
	{
		return $this->defaultResponse($this->service->getMetricsReport($request->get('start_date'), $request->get('end_date')), Response::HTTP_CREATED);
	}
}
