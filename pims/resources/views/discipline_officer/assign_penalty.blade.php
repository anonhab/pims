<!-- resources/views/discipline_officer/assign_penalty.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Assign Penalty</h2>

    <form action="{{ route('discipline_officer.store_penalty') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="prisoner_id">Prisoner</label>
            <select name="prisoner_id" class="form-control" required>
                <!-- Assuming you have a list of prisoners -->
                @foreach($prisoners as $prisoner)
                    <option value="{{ $prisoner->id }}">{{ $prisoner->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="penalty_type">Penalty Type</label>
            <input type="text" name="penalty_type" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="penalty_details">Penalty Details</label>
            <textarea name="penalty_details" class="form-control" required></textarea>
        </div>

        <button type="submit" class="btn btn-success mt-3">Assign Penalty</button>
    </form>
</div>
@endsection
