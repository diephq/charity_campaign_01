<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contribution;
use App\Repositories\Contribution\ContributionRepositoryInterface;

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->contribution->rules);

        $input = $request->only([
            'campaign_id',
            'name',
            'email',
            'amount',
            'description',
        ]);

        $this->contributionRepository->createContribution($input);

        return redirect(action('CampaignController@show', ['id' => $input['campaign_id']]));
    }

    public function confirmContribution(Request $request)
    {
        if ($request->ajax()){
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
