<?php
namespace App\Repositories\Contribution;

use Auth;
use App\Models\Contribution;
use App\Repositories\BaseRepository;
use App\Repositories\Contribution\ContributionRepositoryInterface;
use DB;
use Illuminate\Container\Container;

class ContributionRepository extends BaseRepository implements ContributionRepositoryInterface
{

    protected $container;

    public function __construct(Container $container)
    {
        parent::__construct($container);
    }

    function model()
    {
        return Contribution::class;
    }

    public function createContribution($params = [])
    {
        if (empty($params)) {
            return false;
        }

        $inputs = [];
        foreach ($params['amount'] as $key => $amount) {
            $inputs[] = [
                'category_id' => $key,
                'amount' => $amount,
            ];
        }

        DB::beginTransaction();
        try {
            $this->model->create([
                'campaign_id' => $params['campaign_id'],
                'user_id' => auth()->id() ?: null,
                'name' => isset($params['name']) ? $params['name'] : null,
                'email' => isset($params['email']) ? $params['email'] : null,
                'description' => $params['description'],
            ])->categoryContribution()->createMany($inputs);

            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();

            return false;
        }
    }

    public function getContributions($id)
    {
        return $this->model->where('status', config('constants.ACTIVATED'))
            ->where('campaign_id', $id)
            ->with(['user','categoryCampaigns.category']);
    }
}
