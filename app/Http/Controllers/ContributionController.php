<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contribution;
use App\Repositories\Contribution\ContributionRepositoryInterface;
use App\Http\Requests\ContributionRequest;

class ContributionController extends Controller
{
    protected $contribution;
    protected $contributionRepository;

    public function __construct(Contribution $contribution, ContributionRepositoryInterface $contributionRepository)
    {
        $this->contribution = $contribution;
        $this->contributionRepository = $contributionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * @param ContributionRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ContributionRequest $request)
    {
        if ($request->ajax()) {
            $input = $request->only([
                'campaign_id',
                'name',
                'email',
                'amount',
                'description',
            ]);

            $result = $this->contributionRepository->createContribution($input);

            if ($result) {
                return response()->json([
                    'success' => true,
                    'message' => trans('campaign.create_contribute_success'),
                ]);
            }

            return response()->json(['success' => false]);
        }

        return response()->json(['success' => false]);
    }

    public function confirmContribution(Request $request)
    {
        if ($request->ajax()) {
            $contributionId = $request->get('contribution_id');

            $result = $this->contributionRepository->confirmContribution($contributionId);

            return response()->json($result);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
