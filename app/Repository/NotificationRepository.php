<?php

namespace App\Repository;

use App\Models\Notifications\Notification;
use App\Models\User;

class NotificationRepository
{
    /**
     * @return Notification[]
     */
    public function getAllByUser(User $user, bool $newable = false): array
    {
        $builder = Notification::where(['user' => $user->id]);
        if ($newable) {
            $builder->whereNull('read_at');
        }
        return $builder->get()->toArray();
    }

    public function find(int $id): Notification
    {
        return Notification::find($id);
    }

    public function add(Notification $notification): void
    {
        $notification->saveOrFail();
    }

    public function update(Notification $notification): void
    {
        $notification->updateOrFail();
    }

    public function remove(Notification $notification): void
    {
        $notification->deleteOrFail();
    }
}
