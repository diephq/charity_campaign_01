<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Repositories\Comment\CommentRepositoryInterface;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
    protected $comment;
    protected $commentRepository;

    public function __construct(Comment $comment, CommentRepositoryInterface $commentRepository)
    {
        $this->comment = $comment;
        $this->commentRepository = $commentRepository;
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

            return response()->json($result);
        }

        return response()->json(['success' => false]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
