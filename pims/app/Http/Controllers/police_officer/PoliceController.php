<?php

namespace App\Http\Controllers\police_officer;

use App\Http\Controllers\Controller;
use App\Models\PolicePrisonerAssignment;
use App\Models\Prisoner;
use App\Models\Requests;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PoliceController extends Controller
{
    public function unallocatePrisoner(Request $request, $prisonerId)
    {
        // Validate the prisoner ID
        $request->validate([
            'prisoner_id' => 'required|exists:prisoners,id',
        ]);

        // Ensure the prisoner belongs to the officer's prison
        $prisonId = Session::get('prison_id');
        $prisoner = Prisoner::where('id', $prisonerId)
            ->where('prison_id', $prisonId)
            ->firstOrFail();

        // Check if prisoner is allocated to a room
        if (!$prisoner->room_id) {
            return response()->json([
                'success' => false,
                'message' => 'Prisoner is not allocated to any room.',
            ], 400);
        }

        // Unallocate by setting room_id to null
        $prisoner->room_id = null;
        $prisoner->save();

        return response()->json([
            'success' => true,
            'message' => 'Prisoner unallocated successfully.',
            'prisoner_id' => $prisoner->id,
        ]);
    }
    public function dashboard()
    {
        $userId = Session::get('user_id');
        $prisonId = Session::get('prison_id');

        // Fetch assigned prisoners
        $assignments = PolicePrisonerAssignment::where('officer_id', $userId)
            ->with(['prisoner' => function ($query) {
                $query->select('id', 'first_name', 'last_name', 'status', 'room_id', 'created_at');
            }])
            ->get();

        $assignedPrisonersCount = $assignments->count();
        $prisonerList = $assignments->map(function ($assignment) {
            return [
                'id' => $assignment->prisoner->id,
                'name' => $assignment->prisoner->first_name . ' ' . $assignment->prisoner->last_name,
                'status' => $assignment->prisoner->status,
                'assignment_date' => $assignment->assignment_date,
                'room_id' => $assignment->prisoner->room_id,
            ];
        });

        // Fetch recent requests
        $requests = Requests::where('prison_id', $prisonId)
            ->with(['prisoner' => function ($query) {
                $query->select('id', 'first_name', 'last_name');
            }])
            ->latest()
            ->take(3)
            ->get()
            ->map(function ($request) {
                return [
                    'type' => $request->request_type,
                    'prisoner_name' => $request->prisoner ? $request->prisoner->first_name . ' ' . $request->prisoner->last_name : 'N/A',
                    'status' => $request->status,
                    'created_at' => $request->created_at->format('Y-m-d H:i'),
                    'id' => $request->id,
                ];
            });

        // Fetch room allocations
        $rooms = Room::where('prison_id', $prisonId)
            ->withCount(['prisoners' => function ($query) {
                $query->where('status', 'Active');
            }])
            ->get();

        $roomAllocationCount = $rooms->sum('prisoners_count');
        $roomAllocationData = [
            'labels' => $rooms->pluck('room_number')->toArray(),
            'data' => $rooms->pluck('prisoners_count')->toArray(),
        ];

        // Fetch pending requests count
        $pendingRequestsCount = Requests::where('prison_id', $prisonId)
            ->where('status', 'pending')
            ->count();

        return view('police_officer.dashboard', compact(
            'assignedPrisonersCount',
            'prisonerList',
            'requests',
            'roomAllocationCount',
            'roomAllocationData',
            'pendingRequestsCount'
        ));
    }
    public function show($id)
    {
        $prisoner = Prisoner::with('prison')->findOrFail($id);
        return response()->json([
            'id' => $prisoner->id,
            'first_name' => $prisoner->first_name,
            'middle_name' => $prisoner->middle_name,
            'last_name' => $prisoner->last_name,
            'dob' => $prisoner->dob->format('F j, Y'),
            'gender' => $prisoner->gender,
            'marital_status' => $prisoner->marital_status,
            'crime_committed' => $prisoner->crime_committed,
            'status' => $prisoner->status,
            'time_serve_start' => $prisoner->time_serve_start->format('F j, Y'),
            'time_serve_end' => $prisoner->time_serve_end->format('F j, Y'),
            'address' => $prisoner->address,
            'emergency_contact_name' => $prisoner->emergency_contact_name,
            'emergency_contact_relation' => $prisoner->emergency_contact_relation,
            'emergency_contact_number' => $prisoner->emergency_contact_number,
            'inmate_image' => $prisoner->inmate_image,
            'prison_id' => $prisoner->prison_id,
            'prison_name' => $prisoner->prison->name ?? 'N/A',
            'room_id' => $prisoner->room_id,
            'created_at' => $prisoner->created_at->format('F j, Y, g:i A'),
            'updated_at' => $prisoner->updated_at->format('F j, Y, g:i A'),
        ]);
    }
    
    // Show form to allocate a room
    public function allocateRoom()
    {
        return view('police_officer.allocate_room');
    }

    // Store the room allocation
    public function storeRoomAllocation(Request $request)
    {
        // Logic to store the room allocation in the database
        // Example: RoomAllocation::create($request->all());

     //   return redirect()->route('police_officer.viewRoomAllocations')->with('success', 'Room allocated successfully');
    }

    // Show form to create a request
    public function createRequest()
    {
        return view('police_officer.createRequest');
    }

    // Store the request
    public function storeRequest(Request $request)
    {
        // Logic to save the request to the database
        // Example: Request::create($request->all());

        return redirect()->route('police_officer.viewRequests')->with('success', 'Request created successfully');
    }

    // View list of prisoners
    public function viewPrisoners()
    {
        // Fetch the prisoners from the database
        // Example: $prisoners = Prisoner::all();

        return view('police_officer.viewPrisoners');
    }

    // View list of requests
    public function viewRequests()
    {
        // Fetch the requests from the database
        // Example: $requests = Request::all();

        return view('police_officer.viewRequests');
    }

    // View list of room allocations
    public function viewRoomAllocations()
    {
        // Fetch the room allocations from the database
        // Example: $roomAllocations = RoomAllocation::all();

        return view('police_officer.viewRoomAllocations');
    }
}

