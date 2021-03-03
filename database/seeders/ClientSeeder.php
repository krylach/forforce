<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Clients\Operator;
use App\Models\Clients\Number;
use App\Models\Clients\Client;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $operators = Operator::all();

        DB::transaction(function () use ($operators) {
            for ($i = 0; $i < 2000; $i++) { 
                $faker = Faker::create();

                $client = Client::create([
                    'name' => $faker->name,
                    'birthday' => $faker->date
                ]);

                for ($j = 0; $j < $faker->numberBetween(1, 3); $j++) { 
                    $operator = $operators->random();

                    try {
                        $number = Number::create([
                            'operator_id' => $operator->id,
                            'number' => $faker->numberBetween(1000000, 9999999),
                            'balance' => $faker->randomFloat(2, -50, 150)
                        ]);
                    } catch (\Throwable $th) {
                        $number = Number::create([
                            'operator_id' => $operator->id,
                            'number' => $faker->numberBetween(1000000, 9999999),
                            'balance' => $faker->randomFloat(2, -50, 150)
                        ]);
                    }

                    $client->numbers()->attach($number->id);
                }

            }
        });
    }

    private function generateNumber()
    {
        
    }
}
