<?php

use App\Enums\PrizeEnum;
use App\Enums\PrizeRedeemEnum;
use App\Enums\TransactionEnum;
use App\Enums\UserEnum;
use App\Enums\ProductEnum;

use App\Http\Controllers\UserController;
use App\Http\Controllers\PrizeController;
use App\Http\Controllers\PrizeRedeemController;
use App\Http\Controllers\TransactionController;

use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware([RoleMiddleware::class])->group(function () {
	/**
	 * USERS
	 */
	Route::prefix(UserEnum::ROUTE_PREFIX)->group(function () {
		Route::get('/', [UserController::class, 'index'])->name('users.index');
		Route::get('/balance', [UserController::class, 'getUsersBalance'])->name('users.balance');
		Route::post('/', [UserController::class, 'store'])->name('users.store');
		Route::get('/{id}', [UserController::class, 'show'])->name('users.show');
	});

    /**
	 * TRANSACTIONS
	 */
	Route::prefix(TransactionEnum::ROUTE_PREFIX)->group(function () {
		Route::get('/', [TransactionController::class, 'index'])->name('transactions.index');
		Route::get('/metrics', [TransactionController::class, 'metrics'])->name('transactions.metrics');
		Route::post('/', [TransactionController::class, 'store'])->name('transactions.store');
	});

    /**
	 * PRIZES
	 */
	Route::prefix(PrizeEnum::ROUTE_PREFIX)->group(function () {
		Route::get('/', [PrizeController::class, 'index'])->name('prizes.index');
	});

    /**
	 * PRIZE REDEEMS
	 */
	Route::prefix(PrizeRedeemEnum::ROUTE_PREFIX)->group(function () {
		Route::post('/', [PrizeRedeemController::class, 'store'])->name('prize_redeems.store');
	});
});
