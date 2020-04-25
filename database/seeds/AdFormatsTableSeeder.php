<?php

use Illuminate\Database\Seeder;

class AdFormatsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ad_formats')->delete();
        
        \DB::table('ad_formats')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Abstract Banner Large Ads',
                'description' => 'Airpush’s Abstract Banners are new and exciting creative formats that let your message expand into full motion transparent overlays over content. Abstract Banners also give rich media capabilities to performance campaigns because Airpush produces the creative for free and charges no ad serving fees.',
                'parameters' => '{"name":"1","type":"1","title":"1","description":"1","url":"1","image_path":"1"}',
                'thumb_path' => 'abstract_banner_ads.png',
                'image_path' => 'abstract_banner_ads.png',
                'min_bid' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'HD Video Abstract',
                'description' => 'Extend your video reach to the other 98% of mobile. Airpush’s HD Video format replaces boring static banners with high quality video, resulting in huge user engagement and leading campaign ROI.',
                'parameters' => '{
"name": "1",
"vid_type": "1",
"title": "1",
"description": "1",
"advertiser": "1",
"url": "1",
"video_path": "1",
"video_link": "1"
}',
                'thumb_path' => 'hd_video_icon.png',
                'image_path' => 'hd_video_icon.png',
                'min_bid' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'In-App Banner Ads',
                'description' => 'In-App Banner Ads are a staple of the mobile advertising industry and combined with Airpush’s advanced ad types, enable advertisers to reach consumers at virtually every stage of their mobile lives.',
                'parameters' => '{"name":"1","title":"1","description":"1","url":"1","image_path":"1"}',
                'thumb_path' => 'in-app-banner-icon.png',
                'image_path' => 'in-app-banner-icon.png',
                'min_bid' => '3',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Overlay Ads',
            'description' => ' (supported sizes: 300x250, 320x480 and 550x480) Overlay Ads enable advertisers to drive unique engagement by presenting highly relevant offers directly inside the app via unique overlays on top of app content.',
                'parameters' => '{
"name": "1",
"link": "1",
"ad_image_size": "1",
"description": "1",
"image_path": "1"
}',
                'thumb_path' => 'overlay-icon.png',
                'image_path' => 'overlay-icon.png',
                'min_bid' => '10',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Push Ads',
                'description' => 'Push Ads are displayed in the notification tray of Android devices, enabling users to engage with the ads at their convenience.',
                'parameters' => '{"name":"1","title":"1","description":"1","url":"1","image_path":"1"}',
                'thumb_path' => 'push-ads-icon.png',
                'image_path' => 'push-ads-icon.png',
                'min_bid' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Video Ads',
                'description' => 'Airpush’s Video Ads optimized for device type and connection speed, enabling dramatically higher conversions and an improved consumer experience.',
                'parameters' => '{
"name": "1",
"vid_type": "1",
"title": "1",
"description": "1",
"advertiser": "1",
"url": "1",
"video_path": "1",
"video_link": "1"
}',
                'thumb_path' => 'video-ads-icon.png',
                'image_path' => 'video-ads-icon.png',
                'min_bid' => '4',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Rich Media Interstitial Ads',
                'description' => 'Rich Media Ads enable advertisers to deliver interactive content that drives dramatically more engagement than traditional static ads.',
                'parameters' => '{
"name": "1",
"url": "1",
"device": "1",
"description": "1",
"full_page": "1",
"supports": [
{
"1": "Call",
"2": "SMS",
"3": "Store Picture",
"4": "Event",
"5": "Inline video",
"6": "Full video"
}
]
}',
                'thumb_path' => 'rich-media-icon.png',
                'image_path' => 'rich-media-icon.png',
                'min_bid' => '5',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Landing Page Ads',
                'description' => 'Landing Page Ads are displayed to users at natural break points in an app, displaying a full landing page within the app.',
                'parameters' => '{
"name": "1",
"description": "1",
"url": "1"
}',
                'thumb_path' => 'landingpage-ads-icon.png',
                'image_path' => 'landingpage-ads-icon.png',
                'min_bid' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}