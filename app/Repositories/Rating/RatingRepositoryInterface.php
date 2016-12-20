<?php
namespace App\Repositories\Rating;

interface RatingRepositoryInterface
{
    public function ratingCampaign($params = []);

    public function checkUserRatingCampaign($campaignId);

    public function averageRatingCampaign($campaignId);
}
