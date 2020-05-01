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
                'id' => 1,
                'name' => 'live',
                'class' => 'badge badge-pill badge-primary',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'stopped',
                'class' => 'badge badge-pill badge-secondary',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'completed',
                'class' => 'badge badge-pill badge-success',
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'expired',
                'class' => 'badge badge-pill badge-warning',
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'pending',
                'class' => 'badge badge-pill badge-danger',
            ),
            5 =>
            array (
                'id' => 6,
                'name' => 'rejected',
                'class' => 'badge badge-pill badge-danger',
            ),
            6 =>
            array (
                'id' => 7,
                'name' => 'pending_review',
                'class' => 'badge badge-pill badge-info',
            ),
        ));


    }
}
