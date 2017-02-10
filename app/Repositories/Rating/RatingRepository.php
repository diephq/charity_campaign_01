<?php
namespace App\Repositories\Rating;

use App\Models\User;
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

            $averageRatingCampaign = $this->averageRatingCampaign($params['campaign_id']);
            $dataChart = $this->getRatingChart($params['campaign_id'], false);

            return [
                'dataAverage' => $averageRatingCampaign,
                'dataChart' => $dataChart,
            ];
        }

        $this->model->create([
            'user_id' => auth()->id(),
            'star' => $params['value'],
            'target_id' => $params['campaign_id'],
            'target_type' => config('constants.RATING_CAMPAIGN'),
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
            ->where('target_type', config('constants.RATING_CAMPAIGN'))
            ->first();
    }

    public function averageRatingCampaign($campaignId)
    {
        if (!$campaignId) {
            return false;
        }

        $ratings = $this->model->where('target_id', $campaignId)
            ->where('target_type', config('constants.RATING_CAMPAIGN'))
            ->get();

        if (!count($ratings)) {
            return [
                'average' => 0,
                'amount' => count($ratings),
            ];
        }

        $star = array_sum($ratings->pluck('star')->toArray());

        return [
            'average' => (float)$star / count($ratings),
            'amount' => count($ratings),
        ];
    }

    public function getRatingChart($campaignId, $isResponseJson = true)
    {
        if (!$campaignId) {
            return false;
        }

        $ratings = $this->model->select('star', DB::raw('count(*) as total'))
            ->where('target_id', $campaignId)
            ->where('target_type', config('constants.RATING_CAMPAIGN'))
            ->groupBy('star')
            ->orderBy('star')
            ->get();

        $result = [];
        foreach ($ratings as $key => $rating) {
            $result[$rating->star] = $rating->total;
        }

        return $isResponseJson ? json_encode($result) : $result;
    }

    public function ratingUser($params = [])
    {
        if (empty($params)) {
            return false;
        }

        DB::beginTransaction();
        try {
            $rating = $this->checkUserRatingUser($params['targetId']);

            if ($rating) {
                $rating->star = $params['value'];
                $rating->save();

                $dataRating = $this->averageRatingUser($params['targetId']);
                $this->__updateStarAverage($params['targetId'], $dataRating['average']);
                DB::commit();

                return $dataRating;
            }

            $this->model->create([
                'user_id' => auth()->id(),
                'star' => $params['value'],
                'target_id' => $params['targetId'],
                'target_type' => config('constants.RATING_USER'),
            ]);

            $dataRating = $this->averageRatingUser($params['targetId']);
            $this->__updateStarAverage($params['targetId'], $dataRating['average']);
            DB::commit();

            return $dataRating;
        } catch (Exception $e) {
            DB::rollBack();

            return false;
        }
    }

    public function checkUserRatingUser($targetId)
    {
        if (!$targetId) {
            return false;
        }

        return $this->model->where('user_id', auth()->id())
            ->where('target_id', $targetId)
            ->where('target_type', config('constants.RATING_USER'))
            ->first();
    }

    public function averageRatingUser($targetId)
    {
        if (!$targetId) {
            return false;
        }

        $ratings = $this->model->where('target_id', $targetId)
            ->where('target_type', config('constants.RATING_USER'))
            ->get();

        if ($ratings->isEmpty()) {
            return [
                'average' => 0,
                'amount' => count($ratings),
            ];
        }

        $star = array_sum($ratings->pluck('star')->toArray());

        return [
            'average' => round($star / count($ratings), 2),
            'amount' => count($ratings),
        ];
    }

    private function __updateStarAverage($userId, $data)
    {
        if (!$userId || !$data) {
            return false;
        }

        return User::find($userId)->update(['star' => $data]);
    }

    public function listUserRating($userId)
    {
        if (empty($userId)) {
            return [];
        }

        return $this->model->where('target_id', $userId)
            ->with('user')
            ->get();
    }

}
