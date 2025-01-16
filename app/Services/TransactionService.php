<?php

namespace App\Services;

use App\Mail\PointsEarnedMail;
use App\Repositories\TransactionRepository;
use Illuminate\Database\Eloquent\Model;
use Mail;

class TransactionService extends BaseService
{
	public function __construct(TransactionRepository $repository)
	{
		parent::__construct($repository);
	}

	public function saveRecord(array $data) : Model
	{
		$userService = new UserService();

		$transaction = parent::saveRecord($data);

		$transaction->items()->createMany($data['items']);

		$user = $userService->findRecord($data['user_id']);

		$mailData = [
			'total_price' => $transaction->total,
			'date' => $transaction->date,
			'points' => floor($transaction->total / 5),
		]; 
		
		Mail::to($user->email)->send(new PointsEarnedMail($mailData));

		return $transaction;
	}
}