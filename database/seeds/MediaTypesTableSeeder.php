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
                'id' => 2,
                'name' => 'link',
                'metadata' => '{ "name": "1", "title": "1", "url": "1", "max":"1", "image_path": "1" }',
                'allowed_types' => '.jpg,.jpeg,.png',
                'max' => 3,
                'min' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 3,
                'name' => 'carousel',
                'metadata' => '{"name":"1","type":"1","title":"1","description":"1","url":"1","image_path":"1"}',
                'allowed_types' => '.jpg,.jpeg,.png',
                'max' => 7,
                'min' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 5,
                'name' => 'slideshow',
                'metadata' => '{"name":"1","type":"1","title":"1","description":"1","url":"1","image_path":"1"}',
                'allowed_types' => '.jpg,.jpeg,.png',
                'max' => 15,
                'min' => 3,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 6,
                'name' => 'video',
                'metadata' => '{"name":"1","type":"1","title":"1","description":"1","url":"1","video_path":"1"}',
                'allowed_types' => '.avi,.mpg,.mov,.gif,.mp4',
                'max' => 2,
                'min' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}