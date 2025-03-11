<!DOCTYPE html>
<html>

@include('includes.head')

<body>
    @include('includes.nav')
    
    <div class="columns" id="app-content">
        @include('inspector.menu')

        <div class="column is-10" id="page-content">
            <div class="content-header">
                <h2 class="title">Visitor Details</h2>
            </div>

            <div class="content-body">
                <div class="card">
                    <div class="card-content">
                        <table class="table is-striped is-fullwidth">
                            <thead>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Phone Number</th>
                                    <th>Relationship</th>
                                    <th>Address</th>
                                    <th>Identification Number</th>
                                    <th>Username</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($visitors as $visitor)
                                <tr>
                                    <td>{{ $visitor->first_name }}</td>
                                    <td>{{ $visitor->last_name }}</td>
                                    <td>{{ $visitor->phone_number }}</td>
                                    <td>{{ $visitor->relationship }}</td>
                                    <td>{{ $visitor->address }}</td>
                                    <td>{{ $visitor->identification_number }}</td>
                                    <td>{{ $visitor->username }}</td>
                                    <td>{{ $visitor->created_at }}</td>
                                    <td>{{ $visitor->updated_at }}</td>
                                    <td>
                                        <a href="{{ route('visitor.edit', $visitor->id) }}" class="button is-small is-link">Edit</a>
                                        <form action="{{ route('visitor.destroy', $visitor->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="button is-small is-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('includes.footer_js')
</body>
</html>
