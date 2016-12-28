<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Follow\FollowRepositoryInterface;

class FollowController extends BaseController
{
    protected $followRepository;

    public function __construct(FollowRepositoryInterface $followRepository)
    {
        $this->followRepository = $followRepository;
    }

    public function followOrUnFollowUser(Request $request)
    {
        if ($request->ajax()) {
            $targetId = $request->get('target_id');
            $result = $this->followRepository->followOrUnFollowUser($targetId);

            if ($result) {
                return response()->json([
                    'success' => true,
                    'result' => $result,
                ]);
            }
        }

        return response()->json(['success' => false]);
    }
}
