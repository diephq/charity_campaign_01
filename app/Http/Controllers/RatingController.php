<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Rating\RatingRepositoryInterface;

class RatingController extends Controller
{
    protected $ratingRepository;

    public function __construct(RatingRepositoryInterface $ratingRepository)
    {
        $this->ratingRepository = $ratingRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function ratingCampaign(Request $request)
    {
        if ($request->ajax()) {
            $inputs = $request->only([
                'value',
                'campaign_id',
            ]);
            $result = $this->ratingRepository->ratingCampaign($inputs);

            return response()->json($result);
        }
    }

    public function ratingUser(Request $request)
    {
        if ($request->ajax()) {
            $inputs = $request->only([
                'value',
                'targetId',
            ]);
            $result = $this->ratingRepository->ratingUser($inputs);

            return response()->json($result);
        }
    }
}
