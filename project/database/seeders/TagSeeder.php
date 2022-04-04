<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert([
            'name' => '{"en": "#how_you_doin"}',
            'slug' => '{"en": "how-you-doin"}',
        ]);

        DB::table('tags')->insert([
            'name' => '{"en": "#ghd"}',
            'slug' => '{"en": "ghd"}',
        ]);

        DB::table('tags')->insert([
            'name' => '{"en": "#goodday"}',
            'slug' => '{"en": "goodday"}',
        ]);

        DB::table('tags')->insert([
            'name' => '{"en": "#super"}',
            'slug' => '{"en": "super"}',
        ]);

        DB::table('tags')->insert([
            'name' => '{"en": "#cuute"}',
            'slug' => '{"en": "cuute"}',
        ]);

        DB::table('tags')->insert([
            'name' => '{"en": "#slodko"}',
            'slug' => '{"en": "slodko"}',
        ]);

        DB::table('tags')->insert([
            'name' => '{"en": "#tesla"}',
            'slug' => '{"en": "tesla"}',
        ]);

        DB::table('tags')->insert([
            'name' => '{"en": "#hej"}',
            'slug' => '{"en": "hej"}',
        ]);

        DB::table('tags')->insert([
            'name' => '{"en": "#witam"}',
            'slug' => '{"en": "witam"}',
        ]);
    }
}
