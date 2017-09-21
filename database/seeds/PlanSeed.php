<?php

use Illuminate\Database\Seeder;

class PlanSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [
            	'name' => 'Pro','subscription_period' => 3,
            	'subscription_perice' => 30,'status'=> false 
            ],
            [
            	'name' => 'Extreme','subscription_period' => 4,
            	'subscription_perice' => 40,'status'=> true
            ],
            [
            	'name' => 'Gold','subscription_period' => 5,
            	'subscription_perice' => 50,'status'=> true 
            ],

        ];

        foreach ($items as $item) {
            \App\Plans::create($item);
        }
    }
}
