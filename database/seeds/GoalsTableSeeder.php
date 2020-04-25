<?php

use Illuminate\Database\Seeder;

class GoalsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('goals')->delete();
        
        \DB::table('goals')->insert(array (
            0 => 
            array (
                'created_at' => NULL,
                'description' => 'Local visibility, Store promotion, Store events, Store traffic',
                'id' => 1,
                'name' => 'Brand Awareness',
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'created_at' => NULL,
                'description' => 'Online promotion,Online traffic, Online sales',
                'id' => 2,
                'name' => 'Website Clicks',
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'created_at' => NULL,
                'description' => 'Appointments
Request Quotes
Subscriptions
Forms',
                'id' => 3,
                'name' => 'Business Leads',
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}