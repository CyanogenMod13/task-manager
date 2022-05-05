<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Project\CommentRequest;
use App\Models\Comment;
use App\Models\Task;
use App\Repository\CommentRepository;
use App\Service\CommentService;
use Gate;

class CommentController
{
    public function __construct(
        private CommentService $commentService,
        private CommentRepository $commentRepository
    ) {}

    public function index(Task $task)
    {
        return $this->commentRepository->findByTask($task);
    }

    public function publish(CommentRequest $request, Task $task)
    {
        return $this->commentService->publish($request->content, $task);
    }

    public function edit(CommentRequest $request, Comment $comment)
    {
    }

    public function delete(Comment $comment)
    {
        if (!Gate::allows('delete-comment', $comment)) {
            return response()->json(['message' => 'Deleting denied'], 401);
        }
        $this->commentRepository->remove($comment);
        return ['message' => 'Successfully'];
    }
}
