<?php
namespace App\Repositories\Contribution;

interface ContributionRepositoryInterface
{
    public function createContribution($params = []);

    public function getContributions($id);

    public function getValueContribution($id);

    public function getAllCampaignContributions($campaignId);

    public function confirmContribution($id);
}
