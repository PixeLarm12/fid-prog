<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;

class UserService extends BaseService
{
	public function __construct(UserRepository $repository)
	{
		parent::__construct($repository);
	}

	/**
	 * List all records from Repository.
	 *
	 * @return \Illuminate\Support\Collection
	 */
	public function getAllRecords($nameFilter = null) : \Illuminate\Support\Collection
	{
		return User::query()
        ->when($nameFilter, function ($query, $name) {
            $query->where('name', 'like', "%$name%");
        })
        ->get();
	}
}