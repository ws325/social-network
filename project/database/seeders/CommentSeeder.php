<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
            'text' => 'No co tam?',
            'post_id' => 1,
            'user_id' => 2,
            'created_at'=>Carbon::now()->toDateTimeString(),
        ]);
        DB::table('comments')->insert([
            'text' => 'To prawda',
            'post_id' => 2,
            'user_id' => 1,'created_at'=>Carbon::now()->toDateTimeString(),
        ]);
    }
}
