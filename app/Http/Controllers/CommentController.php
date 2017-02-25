<?php

namespace App\Http\Controllers;

use LRedis;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Repositories\Comment\CommentRepositoryInterface;

class CommentController extends Controller
{
    protected $comment;
    protected $commentRepository;

    public function __construct(Comment $comment, CommentRepositoryInterface $commentRepository)
    {
        $this->comment = $comment;
        $this->commentRepository = $commentRepository;
    }

    public function store(CommentRequest $request)
    {
        if ($request->ajax()){
            $inputs = $request->only([
                'campaign_id',
                'name',
                'email',
                'text',
            ]);

            $comment = $this->commentRepository->createComment($inputs);
            $result = [
                'html' => view('layouts.comment', ['comment' => $comment])->render(),
                'success' => true,
            ];

            if (!$comment->user_id) {
                $result ['name'] = $comment->name;
            } else {
                $comment = $this->commentRepository->getDetail($comment->id);
                $result ['name'] = $comment->user->name;
            }

            $result['campaign_id'] = $inputs['campaign_id'];

            $redis = LRedis::connection();
            $redis->publish('comment', json_encode($result));
        }

        return response()->json(['success' => false]);
    }
}
