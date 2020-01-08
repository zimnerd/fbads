<?php

use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('menus')->delete();
        
        \DB::table('menus')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Dashboard',
                'href' => '/dashboard',
                'icon' => 'cil-speedometer',
                'slug' => 'link',
                'parent_id' => NULL,
                'menu_id' => 1,
                'sequence' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Login',
                'href' => '/login',
                'icon' => 'cil-account-logout',
                'slug' => 'link',
                'parent_id' => NULL,
                'menu_id' => 1,
                'sequence' => 2,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Register',
                'href' => '/register',
                'icon' => 'cil-account-logout',
                'slug' => 'link',
                'parent_id' => NULL,
                'menu_id' => 1,
                'sequence' => 3,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Campaigns',
                'href' => '/campaigns',
                'icon' => 'cil-applications-settings',
                'slug' => 'link',
                'parent_id' => NULL,
                'menu_id' => 1,
                'sequence' => 4,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Users',
                'href' => '/users',
                'icon' => 'cil-people',
                'slug' => 'link',
                'parent_id' => NULL,
                'menu_id' => 1,
                'sequence' => 5,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Settings',
                'href' => NULL,
                'icon' => 'cil-touch-app',
                'slug' => 'dropdown',
                'parent_id' => NULL,
                'menu_id' => 1,
                'sequence' => 6,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Edit menu',
                'href' => '/menu/menu',
                'icon' => NULL,
                'slug' => 'link',
                'parent_id' => 6,
                'menu_id' => 1,
                'sequence' => 7,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Edit menu elements',
                'href' => '/menu/element',
                'icon' => NULL,
                'slug' => 'link',
                'parent_id' => 6,
                'menu_id' => 1,
                'sequence' => 8,
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Edit roles',
                'href' => '/roles',
                'icon' => NULL,
                'slug' => 'link',
                'parent_id' => 6,
                'menu_id' => 1,
                'sequence' => 9,
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Dashboard',
                'href' => '/',
                'icon' => NULL,
                'slug' => 'link',
                'parent_id' => NULL,
                'menu_id' => 2,
                'sequence' => 10,
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Campaigns',
                'href' => '/campaigns',
                'icon' => NULL,
                'slug' => 'link',
                'parent_id' => NULL,
                'menu_id' => 2,
                'sequence' => 11,
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Users',
                'href' => '/users',
                'icon' => NULL,
                'slug' => 'link',
                'parent_id' => NULL,
                'menu_id' => 2,
                'sequence' => 12,
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'Settings',
                'href' => NULL,
                'icon' => NULL,
                'slug' => 'dropdown',
                'parent_id' => NULL,
                'menu_id' => 2,
                'sequence' => 13,
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'Edit menu',
                'href' => '/menu/menu',
                'icon' => NULL,
                'slug' => 'link',
                'parent_id' => 13,
                'menu_id' => 2,
                'sequence' => 14,
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'Edit menu elements',
                'href' => '/menu/element',
                'icon' => NULL,
                'slug' => 'link',
                'parent_id' => 13,
                'menu_id' => 2,
                'sequence' => 15,
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'Edit roles',
                'href' => '/roles',
                'icon' => NULL,
                'slug' => 'link',
                'parent_id' => 13,
                'menu_id' => 2,
                'sequence' => 16,
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'Login',
                'href' => '/login',
                'icon' => NULL,
                'slug' => 'link',
                'parent_id' => NULL,
                'menu_id' => 2,
                'sequence' => 17,
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'Register',
                'href' => '/register',
                'icon' => NULL,
                'slug' => 'link',
                'parent_id' => NULL,
                'menu_id' => 2,
                'sequence' => 18,
            ),
        ));
        
        
    }
}