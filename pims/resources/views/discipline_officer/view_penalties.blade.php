<!-- resources/views/discipline_officer/view_penalties.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">View Assigned Penalties</h2>

    <!-- Display Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Penalties Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Prisoner</th>
                <th>Penalty Type</th>
                <th>Penalty Details</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penalties as $penalty)
                <tr>
                    <td>{{ $penalty->prisoner->name }}</td>
                    <td>{{ $penalty->penalty_type }}</td>
                    <td>{{ $penalty->penalty_details }}</td>
                    <td>
                        <!-- You can add actions like viewing or deleting -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    {{ $penalties->links() }}
</div>
@endsection
