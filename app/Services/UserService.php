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

	/**
	 * List all fidelity points balance sort by user.
	 *
	 * @return \Illuminate\Support\Collection
	 */
	public function getUsersBalance($order = null) : \Illuminate\Support\Collection
	{
		if(!$order) {
			$order = 'desc';
		}

 		return User::query()
				->select('id', 'name', 'fidelity_points') 
				->orderBy('fidelity_points', $order) 
				->get();
	}
}