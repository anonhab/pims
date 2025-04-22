<?php

namespace App\Http\Controllers\police_officer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PoliceController extends Controller
{
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

