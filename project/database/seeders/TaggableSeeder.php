<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaggableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('taggables')->insert([
            'tag_id' => 1,
            'taggable_type' => 'App\Models\Post',
            'taggable_id' => 1
        ]);

        DB::table('taggables')->insert([
            'tag_id' => 2,
            'taggable_type' => 'App\Models\Post',
            'taggable_id' => 1
        ]);

        DB::table('taggables')->insert([
            'tag_id' => 2,
            'taggable_type' => 'App\Models\Post',
            'taggable_id' => 2
        ]);

        DB::table('taggables')->insert([
            'tag_id' => 3,
            'taggable_type' => 'App\Models\Post',
            'taggable_id' => 2
        ]);

        DB::table('taggables')->insert([
            'tag_id' => 4,
            'taggable_type' => 'App\Models\Post',
            'taggable_id' => 3
        ]);

        DB::table('taggables')->insert([
            'tag_id' => 5,
            'taggable_type' => 'App\Models\Post',
            'taggable_id' => 3
        ]);

        DB::table('taggables')->insert([
            'tag_id' => 6,
            'taggable_type' => 'App\Models\Post',
            'taggable_id' => 3
        ]);

        DB::table('taggables')->insert([
            'tag_id' => 2,
            'taggable_type' => 'App\Models\Post',
            'taggable_id' => 4
        ]);

        DB::table('taggables')->insert([
            'tag_id' => 7,
            'taggable_type' => 'App\Models\Post',
            'taggable_id' => 4
        ]);

        DB::table('taggables')->insert([
            'tag_id' => 7,
            'taggable_type' => 'App\Models\Post',
            'taggable_id' => 5
        ]);

        DB::table('taggables')->insert([
            'tag_id' => 8,
            'taggable_type' => 'App\Models\Post',
            'taggable_id' => 5
        ]);

        DB::table('taggables')->insert([
            'tag_id' => 9,
            'taggable_type' => 'App\Models\Post',
            'taggable_id' => 5
        ]);
    }
}
