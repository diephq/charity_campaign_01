<?php
namespace App\Repositories\Rating;

interface RatingRepositoryInterface
{
    public function ratingCampaign($params = []);

    public function checkUserRatingCampaign($campaignId);

    public function averageRatingCampaign($campaignId);

    public function getRatingChart($campaignId, $isResponseJson);

    public function ratingUser($params = []);

    public function averageRatingUser($targetId);

    public function listUserRating($userId);
}
