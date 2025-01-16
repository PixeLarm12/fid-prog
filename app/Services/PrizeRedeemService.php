<?php

namespace App\Services;

use App\Mail\PrizeRedeemedMail;
use App\Repositories\PrizeRedeemRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;

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

		$redeemed = parent::saveRecord($data);

		$mailData = [
			'prize' => ucfirst($prize->title),
			'cost' => $prize->points,
			'balance' => $user->fidelity_points - $prize->points,
			'date' => $redeemed->date
		]; 
		
		Mail::to($user->email)->send(new PrizeRedeemedMail($mailData));

		return $redeemed;
	}
}