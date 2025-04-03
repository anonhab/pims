<!-- resources/views/discipline_officer/view_reports.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">View Generated Reports</h2>

    <!-- Display Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Reports Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Report Details</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reports as $report)
                <tr>
                    <td>{{ $report->report_details }}</td>
                    <td>
                        <!-- You can add actions like viewing or downloading reports -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    {{ $reports->links() }}
</div>
@endsection
