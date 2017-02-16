<?php

use App\Models\CategoryContribution;
use Illuminate\Database\Seeder;

class CategoryContributionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CategoryContribution::truncate();
        factory(CategoryContribution::class, 20)->create();
    }
}
