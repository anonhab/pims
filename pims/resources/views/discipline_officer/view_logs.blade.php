<!-- resources/views/discipline_officer/view_logs.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">View Logs</h2>

    <!-- Logs Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Message</th>
                <th>Log Type</th>
                <th>Timestamp</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
                <tr>
                    <td>{{ $log->message }}</td>
                    <td>{{ $log->log_type }}</td>
                    <td>{{ $log->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    {{ $logs->links() }}
</div>
@endsection
