<?php
namespace App\Repositories\Contribution;

interface ContributionRepositoryInterface
{
    public function createContribution($params = []);

    public function getContributions($id);
}
