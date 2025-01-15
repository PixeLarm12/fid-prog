<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Services\TransactionService;
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

	public function show(string $id)
	{
		return $this->defaultResponse($this->service->findRecord($id));
	}

	public function update(TransactionRequest $request, string $id)
	{
		return $this->defaultResponse($this->service->updateRecord($id, $request->getData()), Response::HTTP_CREATED);
	}
}
