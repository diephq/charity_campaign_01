<?php

use App\Models\Schedule;
use Illuminate\Database\Seeder;

class SchedulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schedule::truncate();
        factory(Schedule::class, 10)->create();
    }
}
