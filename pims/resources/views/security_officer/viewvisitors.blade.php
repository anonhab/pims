
<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.head')
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    
    <!-- NAV -->
    @include('includes.nav')
    
    <div class="flex min-h-screen">
        @include('security_officer.menu')
         
        <div class="flex-1 p-6">
            <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Visitor List</h2>

@if (session('success'))
    <div class="bg-green-500 text-white p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<div class="overflow-x-auto bg-white shadow-lg rounded-lg">
    <table class="min-w-full table-auto text-left">
        <thead class="bg-gray-200">
            <tr>
                <th class="px-4 py-2 text-sm font-semibold text-gray-700">ID</th>
                <th class="px-4 py-2 text-sm font-semibold text-gray-700">First Name</th>
                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Last Name</th>
                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Phone Number</th>
                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Relationship</th>
                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Address</th>
                <th class="px-4 py-2 text-sm font-semibold text-gray-700">ID Number</th>
                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Username</th>
                <th class="px-4 py-2 text-sm font-semibold text-gray-700">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($visitors as $visitor)
            <tr class="border-b hover:bg-gray-100">
                <td class="px-4 py-2 text-sm text-gray-700">{{ $visitor->id }}</td>
                <td class="px-4 py-2 text-sm text-gray-700">{{ $visitor->first_name }}</td>
                <td class="px-4 py-2 text-sm text-gray-700">{{ $visitor->last_name }}</td>
                <td class="px-4 py-2 text-sm text-gray-700">{{ $visitor->phone_number }}</td>
                <td class="px-4 py-2 text-sm text-gray-700">{{ $visitor->relationship }}</td>
                <td class="px-4 py-2 text-sm text-gray-700">{{ $visitor->address }}</td>
                <td class="px-4 py-2 text-sm text-gray-700">{{ $visitor->identification_number }}</td>
                <td class="px-4 py-2 text-sm text-gray-700">{{ $visitor->username }}</td>
                <td class="px-4 py-2 text-sm text-gray-700 flex space-x-2">
                    <a href="{{ route('security_officer.editVisitor', $visitor->id) }}" class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">Edit</a>
                    <form action="{{ route('security_officer.deleteVisitor', $visitor->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this visitor?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<a href="{{ route('security_officer.registerVisitor') }}" class="mt-4 inline-block px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300">Register New Visitor</a>


            </div>
        </div>
    </div>
    
    @include('includes.footer_js')
</body>
</html>
