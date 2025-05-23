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
            $userId = session('user_id') 
                ?? session('lawyer_id') 
                ?? session('visitor_id');
    
            if (!$userId) {
                Log::warning('No valid user session ID found', ['session' => $request->session()->all()]);
                return response()->json(['error' => 'Unauthorized: No user ID found'], 401);
            }
    
            Log::info('Fetching notifications', ['user_id' => $userId]);
    
            $notifications = Notification::forUser($userId)
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
            $userId = session('user_id') 
                ?? session('lawyer_id') 
                ?? session('visitor_id');
    
            if (!$userId) {
                Log::warning('No valid user session ID found for mark-all-read', ['session' => $request->session()->all()]);
                return response()->json(['error' => 'Unauthorized: No user ID found'], 401);
            }
    
            Log::info('Marking all notifications as read', ['user_id' => $userId]);
    
            $updated = Notification::forUser($userId)
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
