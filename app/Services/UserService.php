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
		$order = strtolower($order) ? strtolower($order) : 'desc';

		$users = User::query()
			->select('id', 'name', 'fidelity_points')
			->with('redeemed')
			->orderBy('fidelity_points', $order)
			->get()
			->map(function ($user) {
				return [
					'id' => $user->id,
					'name' => $user->name,
					'fidelity_points' => $user->fidelity_points,
					'redeemed' => $user->redeemed->pluck('name'),
				];
			});
	
		return $users;
	}
}