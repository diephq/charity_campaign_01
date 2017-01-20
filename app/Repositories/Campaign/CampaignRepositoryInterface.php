<?php
namespace App\Repositories\Campaign;

interface CampaignRepositoryInterface
{
    public function getAll();

    public function createCampaign($params = []);

    public function getDetail($id);

    public function joinOrLeaveCampaign($params = []);

    public function checkUserCampaign($params = []);

    public function listCampaignOfUser($userId);

    public function approveOrRemove($params = []);

    public function activeOrCloseCampaign($params = []);

    public function uploadImageCampaign($image);

    public function countCampaign($userId);

    public function searchCampaign($keyWords);

    public function getUserCampaigns($userId);

    public function getMembers($id);
}
