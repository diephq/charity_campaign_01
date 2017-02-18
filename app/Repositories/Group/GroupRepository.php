<?php
namespace App\Repositories\Group;

use DB;
use App\Models\Group;
use App\Repositories\BaseRepository;
use App\Repositories\Group\GroupRepositoryInterface;

class GroupRepository extends BaseRepository implements GroupRepositoryInterface
{
    function model()
    {
        return Group::class;
    }

    public function getGroupIdByCampaignId($campaignId)
    {
        $campaign = $this->model->where('campaign_id', $campaignId)->first();

        if ($campaign) {
            return $campaign->id;
        }
    }

    public function getGroupNameByCampaignId($campaignId)
    {
        $campaign = $this->model->find($campaignId);

        return $campaign ? $campaign->name : null;
    }
}
