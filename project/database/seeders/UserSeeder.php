<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'John Doe',
            'email' => 'john.doe@gmail.com',
            'password' => bcrypt('secret'),
            'nick' => 'J.Doe',
        ]);
        DB::table('users')->insert([
            'name' => 'Jolene Doe',
            'email' => 'jolene.doe@gmail.com',
            'password' => bcrypt('itsasecret'),
            'nick' => 'Jolene',
        ]);

        DB::table('users')->insert([
            'name' => 'Jonas Doe',
            'email' => 'jonas.doe@gmail.com',
            'password' => bcrypt('itsasecret'),
            'nick' => 'Jonas',
        ]);

        DB::table('users')->insert([
            'name' => 'Janice Doe',
            'email' => 'janice.doe@gmail.com',
            'password' => bcrypt('itsasecret'),
            'nick' => 'Janice',
        ]);

        DB::table('users')->insert([
            'name' => 'Joseph Doe',
            'email' => 'joseph.doe@gmail.com',
            'password' => bcrypt('itsasecret'),
            'nick' => 'Joseph',
        ]);

        DB::table('users')->insert([
            'name' => 'Karen Benham',
            'email' => 'karen.benham@gmail.com',
            'password' => bcrypt('secret'),
            'nick' => 'KBenham',
        ]);

        DB::table('users')->insert([
            'name' => 'Mike Thoburn',
            'email' => 'mike.thoburn@gmail.com',
            'password' => bcrypt('secret'),
            'nick' => 'Mike123',
        ]);

        DB::table('users')->insert([
            'name' => 'Orea Chung',
            'email' => 'orea.chung@gmail.com',
            'password' => bcrypt('secret'),
            'nick' => 'Orea33',
        ]);

        DB::table('users')->insert([
            'name' => 'Admin Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('secret'),
            'nick' => 'J.Admin',
            'id' => 10,
            'mod' => true
        ]);

    }

}
