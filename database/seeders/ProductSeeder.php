<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    private const TABLE_NAME = 'products';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table(self::TABLE_NAME)->insert([
            'name' => 'Сыр',
            'price' => 500000,
        ]);

        DB::table(self::TABLE_NAME)->insert([
            'name' => 'Хлеб',
            'price' => 100000,
        ]);

        DB::table(self::TABLE_NAME)->insert([
            'name' => 'Колбаса',
            'price' => 800000,
        ]);
    }
}
