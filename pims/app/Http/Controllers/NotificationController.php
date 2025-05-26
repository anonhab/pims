<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function fetch(Request $request)
{
    try {
        $userId    = session('user_id');
        $lawyerId  = session('lawyer_id'); // ✅ Matches what's stored
        $roleId    = session('role_id');
        $roleName  = session('rolename');
        $prisonId  = session('prison_id');

        Log::info('Attempting to find assigned prisoner', [
            'user_id'   => $userId,
            'lawyer_id' => $lawyerId,
            'role_id'   => $roleId,
            'role_name' => $roleName,
            'prison_id' => $prisonId
        ]);

        $assigned = null;

        if ($roleName === 'lawyer') {
            $assigned = \App\Models\LawyerPrisonerAssignment::where('lawyer_id', $lawyerId)->first();
        } elseif ($roleId == 8) { // Police Officer
            $assigned = \App\Models\PolicePrisonerAssignment::where('officer_id', $userId)->first();
        }

        $prisonerId = $assigned?->prisoner_id;

        // Fetch notifications
        Log::info('Fetching notifications for assigned prisoner and role/prison', [
            'prisoner_id' => $prisonerId,
            'role_id'     => $roleId,
            'prison_id'   => $prisonId
        ]);

        $notifications = Notification::query()
            ->where(function ($query) use ($prisonerId, $prisonId, $roleId) {
                // Case 1: Notifications sent to the assigned prisoner
                if ($prisonerId) {
                    $query->orWhere(function ($q) use ($prisonerId, $prisonId) {
                        $q->where('recipient_id', $prisonerId)
                          ->where('recipient_role', null)
                          ->where('prison_id', $prisonId);
                    });
                }

                // Case 2: Notifications sent to this role within the same prison
                $query->orWhere(function ($q) use ($roleId, $prisonId) {
                    $q->where('role_id', $roleId)
                      ->where('prison_id', $prisonId);
                });
            })
            ->orderBy('created_at', 'desc')
            ->select('id', 'title', 'message', 'is_read', 'created_at')
            ->limit(50)
            ->get();

        return response()->json($notifications);
    } catch (\Exception $e) {
        Log::error('Failed to fetch notifications', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
            'session_snapshot' => $request->session()->all()
        ]);
        return response()->json(['error' => 'Server error while fetching notifications'], 500);
    }
}




public function markAllAsRead(Request $request)
{
    try {
        $userId    = session('user_id');
        $lawyerId  = session('lawyer_id');
        $roleId    = session('role_id');
        $roleName  = session('rolename');
        $prisonId  = session('prison_id');

        Log::info('Marking notifications as read', [
            'user_id'   => $userId,
            'lawyer_id' => $lawyerId,
            'role_id'   => $roleId,
            'role_name' => $roleName,
            'prison_id' => $prisonId
        ]);

        $assigned = null;

        if ($roleName === 'lawyer') {
            $assigned = \App\Models\LawyerPrisonerAssignment::where('lawyer_id', $lawyerId)->first();
        } elseif ($roleId == 8) { // Police Officer
            $assigned = \App\Models\PolicePrisonerAssignment::where('officer_id', $userId)->first();
        }

        $prisonerId = $assigned?->prisoner_id;

        // Update notifications as read
        Notification::where(function ($query) use ($prisonerId, $prisonId, $roleId) {
            // Case 1: Notifications sent to the assigned prisoner
            if ($prisonerId) {
                $query->orWhere(function ($q) use ($prisonerId, $prisonId) {
                    $q->where('recipient_id', $prisonerId)
                      ->whereNull('recipient_role')
                      ->where('prison_id', $prisonId);
                });
            }

            // Case 2: Notifications sent to this role within the same prison
            $query->orWhere(function ($q) use ($roleId, $prisonId) {
                $q->where('role_id', $roleId)
                  ->where('prison_id', $prisonId);
            });
        })->update(['is_read' => true]);

        return response()->json(['message' => 'Notifications marked as read.']);
    } catch (\Exception $e) {
        Log::error('Failed to mark notifications as read', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
            'session_snapshot' => $request->session()->all()
        ]);
        return response()->json(['error' => 'Server error while marking notifications as read'], 500);
    }
}

}
