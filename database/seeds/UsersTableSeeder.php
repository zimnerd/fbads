<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('users')->delete();

        \DB::table('users')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'organisation' => 'Lesch Inc',
                'email_verified_at' => '2020-01-08 06:49:16',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'menuroles' => 'user,admin',
                'remember_token' => 'yuRfcbYvOP06lLDOERLh4q8m9Wf7cA6By98Msdae7yESC2YOQ7kQ2e6gyis6',
                'created_at' => '2020-01-08 06:49:16',
                'updated_at' => '2020-01-08 06:49:16',
                'deleted_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Edwin Nyagano',
                'email' => 'edganz@icloud.com',
                'organisation' => 'Emmerich, Hudson and Grimes',
                'email_verified_at' => '2020-01-08 06:49:16',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'menuroles' => 'user',
                'remember_token' => 'Bjx5kBWgOx',
                'created_at' => '2020-01-08 06:49:16',
                'updated_at' => '2020-01-08 06:49:16',
                'deleted_at' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'Bartholome Trantow',
                'email' => 'hagenes.santiago@example.org',
                'organisation' => 'Quitzon-Witting',
                'email_verified_at' => '2020-01-08 06:49:16',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'menuroles' => 'user',
                'remember_token' => 'pHQnA7t07K',
                'created_at' => '2020-01-08 06:49:16',
                'updated_at' => '2020-01-08 06:49:16',
                'deleted_at' => NULL,
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'Dr. Anais Marks II',
                'email' => 'berry03@example.com',
                'organisation' => 'Armstrong, Kuvalis and Marvin',
                'email_verified_at' => '2020-01-08 06:49:16',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'menuroles' => 'user',
                'remember_token' => 'muAkB8FUel',
                'created_at' => '2020-01-08 06:49:16',
                'updated_at' => '2020-01-08 06:49:16',
                'deleted_at' => NULL,
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'Angeline Lehner MD',
                'email' => 'zwalter@example.org',
                'organisation' => 'Armstrong-Howe',
                'email_verified_at' => '2020-01-08 06:49:16',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'menuroles' => 'user',
                'remember_token' => 'eDQQL3imHw',
                'created_at' => '2020-01-08 06:49:16',
                'updated_at' => '2020-01-08 06:49:16',
                'deleted_at' => NULL,
            ),
            5 =>
            array (
                'id' => 6,
                'name' => 'Sage Nikolaus',
                'email' => 'ghettinger@example.org',
                'organisation' => 'Casper Inc',
                'email_verified_at' => '2020-01-08 06:49:16',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'menuroles' => 'user',
                'remember_token' => 'vA8upn5SvN',
                'created_at' => '2020-01-08 06:49:16',
                'updated_at' => '2020-01-08 06:49:16',
                'deleted_at' => NULL,
            ),
            6 =>
            array (
                'id' => 7,
                'name' => 'Miss Carrie Glover PhD',
                'email' => 'olebsack@example.net',
                'organisation' => 'Kemmer, Bauch and Bergnaum',
                'email_verified_at' => '2020-01-08 06:49:16',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'menuroles' => 'user',
                'remember_token' => 'wfS3rzzADz',
                'created_at' => '2020-01-08 06:49:16',
                'updated_at' => '2020-01-08 06:49:16',
                'deleted_at' => NULL,
            ),
            7 =>
            array (
                'id' => 8,
                'name' => 'Dell Kessler III',
                'email' => 'ewintheiser@example.net',
                'organisation' => 'Rodriguez-Rosenbaum',
                'email_verified_at' => '2020-01-08 06:49:16',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'menuroles' => 'user',
                'remember_token' => '0tnVfYekK6',
                'created_at' => '2020-01-08 06:49:16',
                'updated_at' => '2020-01-08 06:49:16',
                'deleted_at' => NULL,
            ),
            8 =>
            array (
                'id' => 9,
                'name' => 'Trever Auer',
                'email' => 'stracke.dillan@example.net',
                'organisation' => 'Zemlak and Sons',
                'email_verified_at' => '2020-01-08 06:49:16',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'menuroles' => 'user',
                'remember_token' => 'FjJxwrMCMQ',
                'created_at' => '2020-01-08 06:49:16',
                'updated_at' => '2020-01-08 06:49:16',
                'deleted_at' => NULL,
            ),
            9 =>
            array (
                'id' => 10,
                'name' => 'Ines Pacocha',
                'email' => 'xpollich@example.org',
                'organisation' => 'Price, Hills and Durgan',
                'email_verified_at' => '2020-01-08 06:49:16',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'menuroles' => 'user',
                'remember_token' => '9CdThhjLvC',
                'created_at' => '2020-01-08 06:49:16',
                'updated_at' => '2020-01-08 06:49:16',
                'deleted_at' => NULL,
            ),
            10 =>
            array (
                'id' => 11,
                'name' => 'Dr. Lucile Stamm PhD',
                'email' => 'eldora81@example.com',
                'organisation' => 'Kirlin Group',
                'email_verified_at' => '2020-01-08 06:49:16',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'menuroles' => 'user',
                'remember_token' => 'JixrbEtfFM',
                'created_at' => '2020-01-08 06:49:16',
                'updated_at' => '2020-01-08 06:49:16',
                'deleted_at' => NULL,
            ),
        ));


    }
}
