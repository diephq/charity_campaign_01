<?php

use App\Models\Campaign;
use App\Models\Image;
use App\Models\UserCampaign;
use Illuminate\Database\Seeder;

class CampaignsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Campaign::truncate();
        $faker = Faker\Factory::create();

        static $userIds;

        factory(Campaign::class, 20)->create()->each(function ($campaign) use ($faker, $userIds) {
            Image::create([
                'campaign_id' => $campaign->id,
                'image' => 'campaign.png',
            ]);

            UserCampaign::create([
                'user_id' => $faker->randomElement($userIds ?: $userIds = App\Models\User::pluck('id')->toArray()),
                'campaign_id' => $campaign->id,
                'is_owner' => 1,
                'status' => 1,
            ]);
        });
    }
}
