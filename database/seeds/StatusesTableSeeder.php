<?php

use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('statuses')->delete();
        
        \DB::table('statuses')->insert(array (
            0 => 
            array (
                'class' => 'badge badge-pill badge-success',
                'created_at' => NULL,
                'description' => NULL,
                'id' => 1,
                'name' => 'live',
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'class' => 'badge badge-pill badge-secondary',
                'created_at' => NULL,
                'description' => NULL,
                'id' => 2,
                'name' => 'stopped',
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'class' => 'badge badge-pill badge-primary',
                'created_at' => NULL,
                'description' => NULL,
                'id' => 3,
                'name' => 'completed',
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'class' => 'badge badge-pill badge-warning',
                'created_at' => NULL,
                'description' => NULL,
                'id' => 4,
                'name' => 'expired',
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'class' => 'badge badge-pill badge-dark',
                'created_at' => NULL,
                'description' => NULL,
                'id' => 5,
                'name' => 'pending',
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'class' => 'badge badge-pill badge-danger',
                'created_at' => NULL,
                'description' => NULL,
                'id' => 6,
                'name' => 'deleted',
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'class' => 'badge badge-pill badge-light',
                'created_at' => NULL,
                'description' => NULL,
                'id' => 7,
                'name' => 'paused',
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'class' => 'badge badge-pill badge-info',
                'created_at' => NULL,
                'description' => NULL,
                'id' => 8,
                'name' => 'pending review',
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'class' => 'badge badge-pill badge-success',
                'created_at' => NULL,
                'description' => NULL,
                'id' => 9,
                'name' => 'ready',
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'class' => 'badge badge-pill badge-warning',
                'created_at' => NULL,
                'description' => NULL,
                'id' => 10,
                'name' => 'rejected',
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}