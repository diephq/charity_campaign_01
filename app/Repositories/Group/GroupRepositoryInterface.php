<?php
namespace App\Repositories\Group;

interface GroupRepositoryInterface
{
    public function getGroupIdByCampaignId($campaignId);

    public function getGroupNameByCampaignId($campaignId);
}
