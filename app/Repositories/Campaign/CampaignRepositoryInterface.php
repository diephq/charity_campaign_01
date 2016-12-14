<?php
namespace App\Repositories\Campaign;

interface CampaignRepositoryInterface
{
    public function getAll();

    public function createCampaign($params = []);

    public function getDetail($id);

    public function joinOrLeaveCampaign($params = []);

    public function checkUserCampaign($params = []);
}
