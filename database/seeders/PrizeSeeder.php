<?php

namespace Database\Seeders;

use App\Models\Prize;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrizeSeeder extends Seeder
{
    public function run(): void
    {
        $prizes = [
            [
                'title' => 'Suco de laranja',
                'points' => 5
            ],
            [
                'title' => '10% de desconto',
                'points' => 10
            ],
            [
                'title' => 'Almoço especial',
                'points' => 20
            ],
        ];

        foreach($prizes as $prize) {
            Prize::create($prize);
        }
    }
}
