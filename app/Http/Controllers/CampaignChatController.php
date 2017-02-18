<?php
namespace App\Http\Controllers;

use LRedis;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Message\MessageRepositoryInterface as MessageRepository;
use App\Repositories\Group\GroupRepositoryInterface as GroupRepository;
use App\Models\User;

class CampaignChatController extends Controller
{
    protected $messageRepository;

    protected $groupRepository;

    public function __construct(
        MessageRepository $messageRepository,
        GroupRepository $groupRepository
    ) {
        $this->messageRepository = $messageRepository;
        $this->groupRepository = $groupRepository;
    }

    public function store(Request $request)
    {
         if ($request->ajax()) {
            $inputs = $request->only([
                'campaign_id',
                'content',
            ]);

            $groupId = $this->groupRepository->getGroupIdByCampaignId($inputs['campaign_id']);
            $currentUser = auth()->user();

            if ($groupId && $currentUser->id) {
                $inputs = array_except($inputs, ['campaign_id']);
                $inputs = array_merge($inputs, [
                    'group_id' => $groupId,
                    'user_id' => $currentUser->id,
                ]);
                $comment = $this->messageRepository->createMessage($inputs);

                if ($comment) {
                    $dataLayout = [
                        'content' => $inputs['content'],
                        'time' => $comment->created_at->diffForHumans(),
                        'avatar' => $currentUser->avatar,
                        'name' => $currentUser->name,
                    ];
                    $messageSendHtml = view('layouts.message_send', $dataLayout)->render();
                    $messageReceiveHtml = view('layouts.message_receive', $dataLayout)->render();

                    $redis = LRedis::connection();
                    $redis->publish('message', json_encode([
                        'success' => 'true',
                        'campaign_id' => $request->campaign_id,
                        'html' => $messageReceiveHtml,
                        'user_id' => $currentUser->id,
                    ]));

                    return response()->json([
                        'success' => true,
                        'html' => $messageSendHtml,
                    ]);
                }
            }
        }

        return response()->json(['success' => false]);
    }
}
