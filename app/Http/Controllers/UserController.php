<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends BaseController
{
	public function __construct(UserService $service)
	{
		parent::__construct($service);
	}

	public function index(Request $request)
	{
		return $this->defaultResponse($this->service->getAllRecords($request->get('name')));
	}

	public function store(UserRequest $request)
	{
		return $this->defaultResponse($this->service->saveRecord($request->getData()), Response::HTTP_CREATED);
	}

	public function show(string $id)
	{
		return $this->defaultResponse($this->service->findRecord($id));
	}
	
	public function getUsersBalance(Request $request)
	{
		return $this->defaultResponse($this->service->getUsersBalance($request->get('order')));
	}
}