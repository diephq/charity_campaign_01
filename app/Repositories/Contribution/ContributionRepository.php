<?php
namespace App\Repositories\Contribution;

use App\Models\Category;
use App\Models\CategoryCampaign;
use Auth;
use App\Models\Contribution;
use App\Repositories\BaseRepository;
use App\Repositories\Contribution\ContributionRepositoryInterface;
use DB;
use Illuminate\Container\Container;
use App\Models\CategoryContribution;

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
                'amount' => $amount != 0 ? $amount : 0,
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
            ])->categoryContributions()->createMany($inputs);

            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();

            return false;
        }
    }

    public function getContributions($id)
    {
        if (!$id) {
            return false;
        }

        return $this->model->where('status', config('constants.ACTIVATED'))
            ->where('campaign_id', $id)
            ->with(['user', 'categoryContributions.category']);
    }

    public function getValueContribution($id)
    {
        if (!$id) {
            return false;
        }

        $categoryContributions = CategoryContribution::whereHas('contribution', function($query) use ($id) {
            $query->where('campaign_id', $id)
                ->where('status', config('constants.ACTIVATED'));
            })
            ->with('category')
            ->selectRaw('category_id, sum(amount) as amount')
            ->groupBy('category_id')
            ->get();

        $categoryCampaign = CategoryCampaign::where('campaign_id', $id)
            ->with('category')
            ->get();

        $data = [];
        if (!count($categoryContributions)) {
            foreach ($categoryCampaign as $value) {
                $data[] = [
                    'name' => $value->category->name,
                    'value' => config('constants.EMPTY_DATA'),
                    'progress' => config('constants.EMPTY_DATA'),
                ];
            }
        }

        foreach ($categoryCampaign as $value) {
            foreach ($categoryContributions as $categoryContribution) {
                if ($value->category_id == $categoryContribution->category_id) {
                    $data[] = [
                        'name' => $value->category->name,
                        'value' => $categoryContribution->amount,
                        'progress' => round($categoryContribution->amount/$value->goal * 100,
                            config('constants.ROUND_CHART'))
                    ];
                }
            }
        }

        return $data;
    }

    public function getAllCampaignContributions($campaignId)
    {
        if (!$campaignId) {
            return false;
        }

        return $this->model->where('campaign_id', $campaignId)
            ->with(['user', 'categoryContributions.category']);
    }

    public function confirmContribution($id)
    {
        if (!$id) {
            return false;
        }

        $contribution = $this->model->find($id);

        if (empty($contribution))
        {
            return false;
        }

        $contribution->status = $contribution->status ? config('constants.NOT_ACTIVE') : config('constants.ACTIVATED');
        $contribution->save();

        return $contribution;
    }
}
