<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitors List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Visitor List</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Phone Number</th>
                <th>Relationship</th>
                <th>Address</th>
                <th>Identification Number</th>
                <th>Username</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($visitors as $visitor)
            <tr>
                <td>{{ $visitor->id }}</td>
                <td>{{ $visitor->first_name }}</td>
                <td>{{ $visitor->last_name }}</td>
                <td>{{ $visitor->phone_number }}</td>
                <td>{{ $visitor->relationship }}</td>
                <td>{{ $visitor->address }}</td>
                <td>{{ $visitor->identification_number }}</td>
                <td>{{ $visitor->username }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('security_officer.registerVisitor') }}" class="btn btn-primary">Register New Visitor</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>