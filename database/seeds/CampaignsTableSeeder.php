<?php

use Illuminate\Database\Seeder;

class CampaignsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('campaigns')->delete();
        
        \DB::table('campaigns')->insert(array (
            0 => 
            array (
                'id' => 1,
                'created_at' => '2020-01-02 04:58:39',
                'updated_at' => '2020-01-08 07:26:24',
                'deleted_at' => NULL,
                'start' => '2019-12-30 00:00:00',
                'end' => '2020-01-31 00:00:00',
                'name' => 'Kaitlin Mcknight',
                'geo_targeting' => 'KwaZulu-Natal',
                'day_parting' => 'afternoon',
                'devices' => 'ios',
                'ad_format_id' => 8,
                'traffic_source' => 'mobile websites',
                'status_id' => 1,
                'category_id' => 10,
                'user_id' => 1,
                'daily_budget' => '75',
                'current_bid' => '3',
            ),
            1 => 
            array (
                'id' => 2,
                'created_at' => '2020-01-02 07:55:53',
                'updated_at' => '2020-01-08 07:26:18',
                'deleted_at' => NULL,
                'start' => '2019-12-30 00:00:00',
                'end' => '2020-01-01 00:00:00',
                'name' => 'Risa Hardin',
                'geo_targeting' => 'all',
                'day_parting' => 'morning',
                'devices' => 'all',
                'ad_format_id' => 1,
                'traffic_source' => 'mobile websites',
                'status_id' => 7,
                'category_id' => 7,
                'user_id' => 1,
                'daily_budget' => '66',
                'current_bid' => '45',
            ),
            2 => 
            array (
                'id' => 3,
                'created_at' => '2020-01-02 09:00:55',
                'updated_at' => '2020-01-08 07:04:02',
                'deleted_at' => '2020-01-08 07:04:02',
                'start' => '2019-12-30 00:00:00',
                'end' => '2020-01-01 00:00:00',
                'name' => 'Amanda Carney',
                'geo_targeting' => 'North West',
                'day_parting' => 'day',
                'devices' => 'android',
                'ad_format_id' => 2,
                'traffic_source' => 'mobile websites',
                'status_id' => 6,
                'category_id' => 7,
                'user_id' => 1,
                'daily_budget' => '84',
                'current_bid' => '67',
            ),
            3 => 
            array (
                'id' => 4,
                'created_at' => '2020-01-08 06:49:44',
                'updated_at' => '2020-01-08 07:03:08',
                'deleted_at' => '2020-01-08 07:03:08',
                'start' => '2019-12-30 00:00:00',
                'end' => '2020-01-31 00:00:00',
                'name' => 'Emma Todd',
                'geo_targeting' => 'Eastern Cape',
                'day_parting' => 'afternoon',
                'devices' => 'android',
                'ad_format_id' => 1,
                'traffic_source' => 'mobile websites',
                'status_id' => 6,
                'category_id' => 10,
                'user_id' => 1,
                'daily_budget' => '89',
                'current_bid' => '59',
            ),
            4 => 
            array (
                'id' => 5,
                'created_at' => '2020-01-08 07:32:47',
                'updated_at' => '2020-01-08 07:34:51',
                'deleted_at' => NULL,
                'start' => '2019-12-30 00:00:00',
                'end' => '2020-01-31 00:00:00',
                'name' => 'Tasha Rose',
                'geo_targeting' => 'Eastern Cape',
                'day_parting' => 'All Day',
                'devices' => 'all',
                'ad_format_id' => 7,
                'traffic_source' => 'mobile websites',
                'status_id' => 7,
                'category_id' => 9,
                'user_id' => 1,
                'daily_budget' => '64',
                'current_bid' => '12',
            ),
        ));
        
        
    }
}