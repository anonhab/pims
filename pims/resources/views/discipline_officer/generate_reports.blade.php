<!-- resources/views/discipline_officer/generate_reports.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Generate Report</h2>

    <form action="{{ route('discipline_officer.store_reports') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="report_details">Report Details</label>
            <textarea name="report_details" class="form-control" required></textarea>
        </div>

        <button type="submit" class="btn btn-success mt-3">Generate Report</button>
    </form>
</div>
@endsection
