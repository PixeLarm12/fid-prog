<?php

use App\Enums\PrizeEnum;
use App\Enums\PrizeRedeemEnum;
use App\Enums\TransactionEnum;
use App\Enums\UserEnum;
use App\Enums\ProductEnum;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PrizeController;
use App\Http\Controllers\PrizeRedeemController;
use App\Http\Controllers\TransactionController;

use App\Http\Middleware\JwtMiddleware;
use Illuminate\Support\Facades\Route;

// Route::middleware([JwtMiddleware::class])->group(function () {
	/**
	 * USERS
	 */
	Route::prefix(UserEnum::ROUTE_PREFIX)->group(function () {
		Route::get('/', [UserController::class, 'index'])->name('users.index');
		Route::get('/balance', [UserController::class, 'getUsersBalance'])->name('users.getUsersBalance');
		Route::post('/', [UserController::class, 'store'])->name('users.store');
		Route::get('/{id}', [UserController::class, 'show'])->name('users.show');
	});

	/**
	 * PRODUCTS
	 */
	Route::prefix(ProductEnum::ROUTE_PREFIX)->group(function () {
		Route::get('/', [ProductController::class, 'index'])->name('products.index');
		Route::post('/', [ProductController::class, 'store'])->name('products.store');
		Route::put('/{id}', [ProductController::class, 'update'])->name('products.update');
		Route::get('/{id}', [ProductController::class, 'show'])->name('products.show');
	});

    /**
	 * TRANSACTIONS
	 */
	Route::prefix(TransactionEnum::ROUTE_PREFIX)->group(function () {
		Route::get('/', [TransactionController::class, 'index'])->name('transactions.index');
		Route::post('/', [TransactionController::class, 'store'])->name('transactions.store');
		Route::put('/{id}', [TransactionController::class, 'update'])->name('transactions.update');
		Route::get('/{id}', [TransactionController::class, 'show'])->name('transactions.show');
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
		Route::get('/', [PrizeRedeemController::class, 'index'])->name('prize_redeems.index');
		Route::post('/', [PrizeRedeemController::class, 'store'])->name('prize_redeems.store');
		Route::put('/{id}', [PrizeRedeemController::class, 'update'])->name('prize_redeems.update');
		Route::get('/{id}', [PrizeRedeemController::class, 'show'])->name('prize_redeems.show');
	});
// });
