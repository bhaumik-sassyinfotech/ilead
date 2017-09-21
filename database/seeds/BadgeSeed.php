<?php

use Illuminate\Database\Seeder;

class BadgeSeed extends Seeder
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
            	'name' => 'Badge_1',
            	'badge_image' => '',
            	'badge_point' => '100',
            ],
            [
            	'name' => 'Badge_2',
            	'badge_image' => '',
            	'badge_point' => '200',
            ],
            [
            	'name' => 'Badge_3',
            	'badge_image' => '',
            	'badge_point' => '300',
            ],
            [
            	'name' => 'Badge_4',
            	'badge_image' => '',
            	'badge_point' => '400',
            ],
        ];

        foreach ($items as $item) {
            \App\Badge::create($item);
        }
    }
}
