<?php

namespace App\Http\Controllers\Api\User;

use App\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Notifications\NotificationsCollection;

class NotificationController extends Controller
{
    use ResponseTrait ;

    public function switchNotificationStatus() {
        // Get the authenticated user
        $user = auth()->user();

        // Toggle the notification status of the user
        $user->update(['is_notify' => !$user->is_notify]);

        // Return the response with the updated notification status
        return $this->response('success', __('apis.updated'), ['notify' => (bool) $user->refresh()->is_notify]);
    }

    public function getNotifications()
    {
        // Mark all unread notifications as read for the authenticated user
        auth()->user()->unreadNotifications->markAsRead();

        // Retrieve the paginated notifications for the authenticated user
        $notifications = new NotificationsCollection(
            auth()->user()->notifications()->paginate($this->paginateNum())
        );

        // Return the success response with the notifications data
        return $this->successData(['notifications' => $notifications]);
    }

    public function countUnreadNotifications()
    {
        // Get the authenticated user
        $user = auth()->user();

        // Count the number of unread notifications for the user
        $count = $user->unreadNotifications->count();

        // Return the count of unread notifications
        return $this->successData(['count' => $count]);
    }

    public function deleteNotification($notification_id)
    {
        // Delete the notification for the authenticated user
        auth()->user()->notifications()->where('id', $notification_id)->delete();

        // Return the success message
        return $this->successMsg(__('site.notify_deleted'));
    }

    public function deleteNotifications() {
        // Delete all notifications for the authenticated user
        auth()->user()->notifications()->delete();

        // Return success message
        return $this->successMsg(__('apis.deleted'));
    }
}
