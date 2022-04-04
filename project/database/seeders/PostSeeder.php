<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Spatie\Tags\Tag;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            'text' => 'Co tam? #how_you_doin? #ghd',
            'user_id' => 1,
            'created_at'=>'2019-01-06 17:31:59'
        ]);


        DB::table('posts')->insert([
            'text' => 'Ładny dzisiaj dzien #goodday, #ghd',
            'user_id' => 2,
            'created_at'=>Carbon::now()->toDateTimeString(),
        ]);

        DB::table('posts')->insert([
            'text' => 'Pisze nowy post #super, #cuute, #slodko',
            'created_at'=>'2022-01-06 17:31:59',
            'user_id' => 2,
        ]);


        DB::table('posts')->insert([
            'text' => 'Takze nowy poscik #tesla, #ghd',
            'created_at'=>'2018-05-11 13:29:59',
            'user_id' => 2,
        ]);


        DB::table('posts')->insert([
            'text' => 'Witam wszystkich zgromadzonych #hej #witam #tesla',
            'user_id' => 3,
            'created_at'=>'2018-05-11 13:31:59'
        ]);

        DB::table('posts')->insert([
            'text' => 'Adminnnn',
            'user_id' => 10,
            'created_at'=>'2019-05-11 13:31:59'
        ]);

    }
}
