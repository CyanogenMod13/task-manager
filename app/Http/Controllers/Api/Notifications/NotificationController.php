<?php

namespace App\Http\Controllers\Api\Notifications;

use App\Http\Controllers\Controller;
use App\Models\Notifications\Notification;
use App\Repository\NotificationRepository;
use App\Service\Notifications\NotificationService;
use Auth;

class NotificationController extends Controller
{
    public function __construct(
        private NotificationService $notificationService,
        private NotificationRepository $notificationRepository
    ) {}

    public function index()
    {
        return $this->notificationRepository->getAllByUser(Auth::user(), true);
    }

    public function markAsRead(Notification $notification)
    {
        $this->notificationService->markAsRead($notification);
    }
}
