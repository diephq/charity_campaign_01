<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call(UsersTableSeeder::class);
        $this->call(CampaignsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(ContributionsTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
        $this->call(LikesTableSeeder::class);
        $this->call(CategoryContributionsTableSeeder::class);
        $this->call(RelationshipsTableSeeder::class);
        Model::reguard();
    }
}
