<?php
namespace App\Repositories\Rating;

use Auth;
use App\Models\Rating;
use App\Repositories\BaseRepository;
use App\Repositories\Rating\RatingRepositoryInterface;
use DB;
use Illuminate\Container\Container;

class RatingRepository extends BaseRepository implements RatingRepositoryInterface
{

    protected $container;

    public function __construct(Container $container)
    {
        parent::__construct($container);
    }

    function model()
    {
        return Rating::class;
    }

    public function ratingCampaign($params = [])
    {
        if (empty($params)) {
            return false;
        }

        $rating = $this->checkUserRatingCampaign($params['campaign_id']);

        if ($rating) {
            $rating->star = $params['value'];
            $rating->save();

            return $this->averageRatingCampaign($params['campaign_id']);
        }

        $this->model->create([
            'user_id' => auth()->id(),
            'star' => $params['value'],
            'target_id' => $params['campaign_id'],
            'target_type' => config('constants.CAMPAIGN'),
        ]);

        return $this->averageRatingCampaign($params['campaign_id']);
    }

    public function checkUserRatingCampaign($campaignId)
    {
        if (!$campaignId) {
            return false;
        }

        return $this->model->where('user_id', auth()->id())
            ->where('target_id', $campaignId)
            ->where('target_type', config('constants.CAMPAIGN'))
            ->first();
    }

    public function averageRatingCampaign($campaignId)
    {
        if (!$campaignId) {
            return false;
        }

        $ratings = $this->model->where('target_id', $campaignId)
            ->where('target_type', config('constants.CAMPAIGN'))
            ->get();

        if (!count($ratings)) {
            return [
                'average' => 0,
                'amount' => count($ratings),
            ];
        }
        $star = array_sum($ratings->pluck('star')->toArray());

        return [
            'average' => (float) $star/count($ratings),
            'amount' => count($ratings),
        ];
    }

    public function getRatingChart($campaignId)
    {
        if (!$campaignId) {
            return false;
        }

        $ratings = $this->model->select('star', DB::raw('count(*) as total'))
            ->where('target_id', $campaignId)
            ->where('target_type', config('constants.CAMPAIGN'))
            ->groupBy('star')
            ->orderBy('star')
            ->get();

        $result = [];
        foreach ($ratings as $key => $rating) {
            $result[$rating->star] = $rating->total;
        }

        return json_encode($result);
    }
}
