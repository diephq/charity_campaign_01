<?php
namespace App\Repositories\Campaign;

interface CampaignRepositoryInterface
{
    public function getAll();

    public function createCampaign($params = []);
}
