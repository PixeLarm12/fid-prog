<?php

namespace App\Services;

use App\Mail\PointsEarnedMail;
use App\Models\Transaction;
use App\Repositories\TransactionRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Mail;

class TransactionService extends BaseService
{
	public function __construct(TransactionRepository $repository)
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

	public function getMetricsReport($userId, $startDate, $endDate = null) 
	{
		$startDate = Carbon::parse($startDate)->startOfDay();
		
		if($endDate !== null) {
			$endDate = Carbon::parse($endDate)->endOfDay();
		} else {
			$endDate = Carbon::now();
		}

		$metrics = Transaction::whereBetween('date', [$startDate, $endDate])
			->where('user_id', $userId)
			->selectRaw('SUM(total) as total_spent, SUM(total / 5) as fidelity_points')
			->first();

		if(!$metrics['total_spent']){
			$metrics['total_spent'] = "0.00";
		};

		return [
			'total_spent' => "$ " . $metrics['total_spent'],
			'total_points_earned' => (int) $metrics['fidelity_points'] 
		];
	}
}