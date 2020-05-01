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
                'allowed_types' => '.jpg,.jpeg,.png',
                'created_at' => NULL,
                'id' => 2,
                'max' => 3,
                'metadata' => '{
"name": "1",
"title": "1",
"url": "1",
"max": "3",
"image_path": "1"
}',
                'min' => 1,
                'name' => 'link',
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'allowed_types' => '.jpg,.jpeg,.png',
                'created_at' => NULL,
                'id' => 3,
                'max' => 7,
                'metadata' => '{
"name": "1",
"type": "1",
"title": "1",
"description": "1",
"url": "1",
"max":"7",
"image_path": "1"
}',
                'min' => 2,
                'name' => 'carousel',
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'allowed_types' => '.jpg,.jpeg,.png',
                'created_at' => NULL,
                'id' => 5,
                'max' => 15,
                'metadata' => '{
"name": "1",
"type": "1",
"title": "1",
"description": "1",
"url": "1",
"max":"15",
"image_path": "1"
}',
                'min' => 3,
                'name' => 'slideshow',
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'allowed_types' => '.avi,.mpg,.mov,.gif,.mp4',
                'created_at' => NULL,
                'id' => 6,
                'max' => 2,
                'metadata' => '{
"name": "1",
"type": "1",
"title": "1",
"description": "1",
"url": "1",
"max":"2",
"video_path": "1"
}',
                'min' => 1,
                'name' => 'video',
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}