<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Clients\Operator;

class OperatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $operators = [50 => 'Vodafone', 67 => 'Kyivstar', 63 => 'Lifecell', 68 => 'Kyivstar'];

        DB::transaction(function () use ($operators) {
            foreach ($operators as $key => $value) {
                Operator::create([
                    'name' => $value,
                    'code' => $key
                ]);
            }
        });
    }
}
