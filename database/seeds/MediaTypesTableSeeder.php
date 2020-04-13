<?php

use Illuminate\Database\Seeder;

class MediaTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('media_types')->delete();
        
        \DB::table('media_types')->insert(array (
            0 => 
            array (
                'created_at' => NULL,
                'id' => 2,
                'metadata' => '{
"name": "1",
"title": "1",
"url": "1",
"max":"1",
"image_path": "1",
"video_path": "1"
}',
                'name' => 'link',
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'created_at' => NULL,
                'id' => 3,
                'metadata' => '{"name":"1","type":"1","title":"1","description":"1","url":"1","image_path":"1"}',
                'name' => 'carousel',
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}