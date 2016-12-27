<?php

namespace App\Http\Controllers;

use App\Http\Requests\CampaignRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Repositories\Campaign\CampaignRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Models\Campaign;
use App\Repositories\Contribution\ContributionRepositoryInterface;
use App\Repositories\Rating\RatingRepositoryInterface;
use Validator;
use Purifier;

class CampaignController extends BaseController
{

    protected $campaignRepository;
    protected $campaign;
    protected $categoryRepository;
    protected $contributionRepository;
    protected $ratingRepository;
    protected $categoryCampaignRepository;

    public function __construct(
        CampaignRepositoryInterface $campaignRepository,
        Campaign $campaign,
        CategoryRepositoryInterface $categoryRepository,
        ContributionRepositoryInterface $contributionRepository,
        RatingRepositoryInterface $ratingRepository
    ) {
        $this->campaignRepository = $campaignRepository;
        $this->campaign = $campaign;
        $this->categoryRepository = $categoryRepository;
        $this->contributionRepository = $contributionRepository;
        $this->ratingRepository = $ratingRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campaigns = $this->campaignRepository->getAll()->paginate(config('constants.PAGINATE'));

        return view('campaign.index', compact('campaigns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('campaign.create');
    }

    /**
     * @param CampaignRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CampaignRequest $request)
    {
        $inputs = $request->only([
            'name',
            'image',
            'start_date',
            'end_date',
            'address',
            'description',
            'category',
        ]);
        $inputs['description'] = Purifier::clean($inputs['description']);
        $campaign = $this->campaignRepository->createCampaign($inputs);

        if (!$campaign) {
            return redirect(action('CampaignController@create'))
                ->withMessage(trans('campaign.create_error'));
        }

        return redirect(action('UserController@listUserCampaign', ['id' => auth()->id()]))
            ->with(['alert-success' => trans('campaign.create_success')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->dataView['campaign'] = $this->campaignRepository->getDetail($id);

        if (!$this->dataView['campaign']) {
            return abort(404);
        }

        // get list contributions
        $this->dataView['contributions'] = $this->contributionRepository->getContributions($id)->get();

        // get total contributions
        $this->dataView['results'] = $this->contributionRepository->getValueContribution($id);

        // check user had join campaign
        $this->dataView['userCampaign'] = $this->campaignRepository->checkUserCampaign([
            'user_id' => auth()->id(),
            'campaign_id' => $id,
        ]);

        // get averageRankingCampaign
        $this->dataView['averageRanking'] = $this->ratingRepository->averageRatingCampaign($this->dataView['campaign']->id);

        // get rating chart
        $this->dataView['ratingChart'] = $this->ratingRepository->getRatingChart($id);

        $this->dataView['averageRankingUser'] = $this->ratingRepository->averageRatingUser($this->dataView['campaign']->owner->user_id);

        return view('campaign.show', $this->dataView);
    }

    public function joinOrLeaveCampaign(Request $request)
    {
        if ($request->ajax()) {
            $inputs = $request->only([
                'campaign_id',
            ]);

            $inputs['user_id'] = auth()->id();

            $result = $this->campaignRepository->joinOrLeaveCampaign($inputs);

            return response()->json($result);
        }
    }

    public function approveOrRemove(Request $request)
    {
        if ($request->ajax()) {
            $inputs = $request->only([
                'campaign_id',
                'user_id',
            ]);

            $result = $this->campaignRepository->approveOrRemove($inputs);

            return response()->json($result);
        }
    }

    public function activeOrCloseCampaign(Request $request)
    {
        if ($request->ajax()) {
            $inputs = $request->only([
                'campaign_id',
            ]);

            $result = $this->campaignRepository->activeOrCloseCampaign($inputs);

            return response()->json($result);
        }
    }

    public function uploadImage(Request $request)
    {
        $validator = Validator::make($request->all(), $this->campaign->ruleImage);

        if ($validator->fails()) {
            $message = implode(' ', $validator->errors()->all());

            return view('layouts.upload', [
                'CKEditorFuncNum' => $request->CKEditorFuncNum,
                'data' => [
                    'url' => '',
                    'message' => $message,
                ],
            ]);
        }

        try {
            $image = $this->campaignRepository->uploadImageCampaign($request->file('upload'));

            return view('layouts.upload', [
                'CKEditorFuncNum' => $request->CKEditorFuncNum,
                'data' => [
                    'url' => $image,
                    'message' => trans('campaign.upload_image_success'),
                ],
            ]);
        } catch (\Exception $ex) {
            return [
                'status' => false,
                'message' => trans('campaign.upload_image_error') . $ex->getMessage(),
            ];
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
