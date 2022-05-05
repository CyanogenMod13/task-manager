<?php

namespace App\Service;

use App\Models\Comment;
use App\Models\Task;
use App\Repository\CommentRepository;
use Auth;

class CommentService
{
    public function __construct(
        private CommentRepository $commentRepository
    ) {}

    public function publish(string $content, Task $task): Comment
    {
        $comment = new Comment();
        $comment->content = $content;
        $comment->task_id = $task->id;
        $comment->user_id = Auth::user()->id;
        $this->commentRepository->add($comment);
        return $comment;
    }
}
