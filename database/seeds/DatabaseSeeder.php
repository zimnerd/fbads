<?php

use Illuminate\Database\Seeder;

//use database\seeds\UsersAndNotesSeeder;
//use database\seeds\MenusTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersAndNotesSeeder::class);
        $this->call(MenusTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(AdFormatsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(StatusesTableSeeder::class);
        $this->call(MediaTypesTableSeeder::class);
        $this->call(InterestsTableSeeder::class);
        $this->call(ObjectivesTableSeeder::class);
        $this->call(GoalsTableSeeder::class);
        $this->call(StatusTableSeeder::class);
    }
}
