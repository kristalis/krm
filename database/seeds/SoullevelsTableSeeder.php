<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Soullevel;

class SoullevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
    		Soullevel::create([
                'level' => 'Visit'
                'level'  => 'New Believer',
                'level' => 'Member'
                'level' => 'Disciple'
                'level' => 'Shepherd'
                'level' => 'Centa'
                'level' => 'Pastor'
    		]);
    	
    }
}
