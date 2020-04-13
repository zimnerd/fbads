<?php

use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('status')->delete();
        
        \DB::table('status')->insert(array (
            0 => 
            array (
                'class' => 'badge badge-pill badge-primary',
                'id' => 1,
                'name' => 'ongoing',
            ),
            1 => 
            array (
                'class' => 'badge badge-pill badge-secondary',
                'id' => 2,
                'name' => 'stopped',
            ),
            2 => 
            array (
                'class' => 'badge badge-pill badge-success',
                'id' => 3,
                'name' => 'completed',
            ),
            3 => 
            array (
                'class' => 'badge badge-pill badge-warning',
                'id' => 4,
                'name' => 'expired',
            ),
            4 => 
            array (
                'class' => 'badge badge-pill badge-danger',
                'id' => 5,
                'name' => 'pending',
            ),
            5 => 
            array (
                'class' => 'badge badge-pill badge-danger',
                'id' => 6,
                'name' => 'rejected',
            ),
        ));
        
        
    }
}