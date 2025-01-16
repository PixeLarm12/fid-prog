<?php

namespace App\Enums;

class RoleEnum extends AbstractEnum
{
    public const ADMIN = '4b5f8f32c96a9aa152e0c6615d4e632f';
    public const MANAGER = '117ae721e424e7f819893edb2c0c5fd6';
    public const CLIENT = '3b7d6e2cb06ba79a9c9744f8e256a39e';

    public const ADMIN_ACCEPTED_ROUTES = [
        'users.store', // 001
        'users.show', // 002
        'users.index', // 003
        'users.balance', // 004
        'prize_redeems.store', // 005
        'transactions.store', // 006
        'transactions.metrics', // 007
        'transactions.index', // created by me
    ];
    
    public const MANAGER_ACCEPTED_ROUTES = [
        'users.show', // 002
        'users.index', // 003
        'users.balance', // 004
    ];
    
    public const CLIENT_ACCEPTED_ROUTES = [
        'prize_redeems.store', // 005
        'transactions.store', // 006
    ];

    public const GLOBAL_ACCEPTED_ROUTES = [
        'prizes.index' // created by me
    ];
}