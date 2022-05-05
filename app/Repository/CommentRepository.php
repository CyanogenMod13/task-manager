<?php

namespace App\Repository;

use App\Models\Comment;
use App\Models\Task;

class CommentRepository
{
    public function find(int $id): Comment
    {
        return Comment::findOrFail($id);
    }

    /**
     * @return Comment[]
     */
    public function findByTask(Task $task): array
    {
        return Comment::where(['task_id' => $task->id])->get()->toArray();
    }

    public function add(Comment $comment): void
    {
        $comment->saveOrFail();
    }

    public function remove(Comment $comment): void
    {
        $comment->deleteOrFail();
    }

    public function update(Comment $comment): void
    {
        $comment->updateOrFail();
    }
}
