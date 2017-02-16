<?php

use App\Models\Contribution;
use Illuminate\Database\Seeder;

class ContributionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contribution::truncate();
        factory(Contribution::class, 20)->create();
    }
}
