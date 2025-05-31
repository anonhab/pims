<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function fetch(Request $request)
{
    try {
        $lawyerId = session('lawyer_id');
        $prisonId = session('prison_id');
        $roleName = session('rolename');
        $userId = session('user_id');
        $roleId = session('role_id');

        Log::info('Fetching notifications', compact('lawyerId', 'prisonId', 'roleName', 'userId', 'roleId'));

        if ($roleName === 'lawyer' && $lawyerId) {
            // Lawyer case
            $prisonerIds = DB::table('lawyer_prisoner_assignment')
                ->where('lawyer_id', $lawyerId)
                ->where('prison_id', $prisonId)
                ->pluck('prisoner_id')
                ->toArray();

            Log::info('Lawyer assigned prisoner IDs', $prisonerIds);

            $notifications = Notification::query()
                ->whereIn('recipient_id', $prisonerIds)
                ->whereIn('recipient_role', ['prisoner', 'lawyer'])
                ->where('prison_id', $prisonId)
                ->orderByDesc('created_at')
                ->limit(50)
                ->get(['id', 'title', 'message', 'is_read', 'created_at']);

            return response()->json($notifications);
        }  elseif ($userId && $roleId && $prisonId) {
            // Case for police officer with role_id 8
            if ($roleId == 8) {
                // Get all prisoners assigned to this police officer in this prison
                $prisonerIds = DB::table('police_prisoner_assignment')
                    ->where('officer_id', $userId)
                    ->where('prison_id', $prisonId)
                    ->pluck('prisoner_id')
                    ->toArray();
        
                Log::info('Police officer assigned prisoner IDs', $prisonerIds);
        
                $notifications = Notification::query()
                    ->whereIn('recipient_id', $prisonerIds)
                    ->whereIn('recipient_role', ['prisoner', 'police_officer']) // Adjust role name as stored
                    ->where('prison_id', $prisonId)
                    ->orderByDesc('created_at')
                    ->limit(50)
                    ->get(['id', 'title', 'message', 'is_read', 'created_at']);
        
                return response()->json($notifications);
            }
        
            // General case for other users
            $notifications = Notification::query()
                ->where('recipient_id', $userId)
                ->where('role_id', $roleId) // Adjust if needed
                ->where('prison_id', $prisonId)
                ->orderByDesc('created_at')
                ->limit(50)
                ->get(['id', 'title', 'message', 'is_read', 'created_at']);
        
            return response()->json($notifications);
        } else {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

    } catch (\Exception $e) {
        Log::error('Error fetching notifications', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
            'session_data' => session()->all(),
        ]);

        return response()->json(['error' => 'Something went wrong'], 500);
    }
}

    
    



public function markAllAsRead(Request $request)
{
    try {
        // Get user info from session
        $userId = session('user_id') ?? session('lawyer_id') ?? session('visitor_id');
        $roleId = session('role_id');
        $prisonId = session('prison_id');
        $roleName = session('rolename');

        if (!$userId || !$roleId || !$prisonId) {
            Log::warning('Missing session data for markAllAsRead', [
                'session' => $request->session()->all()
            ]);
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        Log::info('Marking notifications as read', compact('userId', 'roleId', 'roleName', 'prisonId'));

        // Special case: lawyer
        if ($roleName === 'lawyer') {
            $prisonerIds = DB::table('lawyer_prisoner_assignment')
                ->where('lawyer_id', $userId)
                ->where('prison_id', $prisonId)
                ->pluck('prisoner_id')
                ->toArray();

            $updated = Notification::query()
                ->whereIn('recipient_id', $prisonerIds)
                ->whereIn('recipient_role', ['prisoner', 'lawyer'])
                ->where('prison_id', $prisonId)
                ->where('is_read', false)
                ->update(['is_read' => true]);

            return response()->json(['success' => true, 'updated' => $updated]);
        }

        // Special case: police officer with assigned prisoners
        if ($roleId == 8) {
            $prisonerIds = DB::table('police_prisoner_assignment')
                ->where('officer_id', $userId)
                ->where('prison_id', $prisonId)
                ->pluck('prisoner_id')
                ->toArray();

            $updated = Notification::query()
                ->whereIn('recipient_id', $prisonerIds)
                ->whereIn('recipient_role', ['prisoner', 'police_officer'])
                ->where('prison_id', $prisonId)
                ->where('is_read', false)
                ->update(['is_read' => true]);

            return response()->json(['success' => true, 'updated' => $updated]);
        }

        // General case
        $updated = Notification::query()
            ->where('recipient_id', $userId)
            ->where('recipient_role', $roleId)
            ->where('prison_id', $prisonId)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return response()->json(['success' => true, 'updated' => $updated]);

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
