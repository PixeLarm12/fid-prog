<?php

namespace App\Services;

use App\Repositories\PrizeRedeemRepository;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;

class PrizeRedeemService extends BaseService
{
	public function __construct(PrizeRedeemRepository $repository)
	{
		parent::__construct($repository);
	}

	/**
	 * Create a new record with Repository.
	 *
	 * @param array $data
	 * @return Model
	 */
	public function saveRecord(array $data) : Model
	{
		$userService = new UserService();
		$prizeService = new PrizeService();

		$user = $userService->findRecord($data['user_id']);

		if(!$user) {
			throw new Exception('User not found', Response::HTTP_NOT_FOUND);
		}

		$prize = $prizeService->findRecord($data['prize_id']);

		if(!$prize) {
			throw new Exception('Prize not found', Response::HTTP_NOT_FOUND);
		}

		if($user->fidelity_points < $prize->points) {
			throw new Exception('User does not have enough balance to redeem prize!', Response::HTTP_UNPROCESSABLE_ENTITY);
		}

		return parent::saveRecord($data);
	}
}