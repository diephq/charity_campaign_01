<?php

use App\Models\Like;
use Illuminate\Database\Seeder;

class LikesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Like::truncate();
        factory(Like::class, 20)->create();
    }
}
