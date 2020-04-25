<?php

use Illuminate\Database\Seeder;

class ObjectivesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('objectives')->delete();
        
        \DB::table('objectives')->insert(array (
            0 => 
            array (
                'created_at' => NULL,
                'description' => 'Promote a business',
                'id' => 1,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'created_at' => NULL,
                'description' => 'Promote a specific product/service',
                'id' => 2,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'created_at' => NULL,
            'description' => 'Communicate a regular/seasonal promotion (not one-off, eg. 50% off every Sunday)',
                'id' => 3,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'created_at' => NULL,
                'description' => 'Make location/phone number more visible',
                'id' => 4,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'created_at' => NULL,
                'description' => 'Promote the possibility to get in touch for a booking or an appointment',
                'id' => 5,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}