<?php

namespace App\Service\Notifications;

use App\Models\Notifications\Notification;
use App\Repository\NotificationRepository;

class NotificationService
{
    public function __construct(
        private NotificationRepository $notificationRepository
    ) {}

    public function markAsRead(Notification $notification)
    {
        $notification->read_at = now();
        $this->notificationRepository->update($notification);
    }
}
