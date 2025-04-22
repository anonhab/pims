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
            <div class="max-w-6xl mx-auto bg-white p-8 rounded-lg shadow-lg">
                <h2 class="text-3xl font-bold text-gray-800 mb-6">Visitor List</h2>

                @if (session('success'))
                    <div class="bg-green-500 text-white p-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                   <!-- Inside your existing visitor card loop -->
@foreach ($visitors as $visitor)
<div class="bg-white rounded-xl shadow-md p-5 border border-gray-200 hover:shadow-lg transition">
    <div class="mb-3">
        <h3 class="text-xl font-semibold text-gray-800">{{ $visitor->first_name }} {{ $visitor->last_name }}</h3>
        <p class="text-sm text-gray-500">Username: {{ $visitor->username }}</p>
    </div>
    <div class="text-sm text-gray-700 space-y-1">
        <p><strong>Phone:</strong> {{ $visitor->phone_number }}</p>
        <p><strong>Relationship:</strong> {{ $visitor->relationship }}</p>
        <p><strong>Address:</strong> {{ $visitor->address }}</p>
        <p><strong>ID Number:</strong> {{ $visitor->identification_number }}</p>
    </div>
    <div class="mt-4 flex space-x-2">
        <button onclick="openModal('editVisitorModal-{{ $visitor->id }}')" class="px-4 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-sm">Edit</button>
        <form action="{{ route('security_officer.deleteVisitor', $visitor->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this visitor?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-4 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-sm">Delete</button>
        </form>
    </div>
</div>

<!-- Edit Modal -->
<div id="editVisitorModal-{{ $visitor->id }}" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-xl mx-auto p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-gray-700">Edit Visitor</h2>
            <button onclick="closeModal('editVisitorModal-{{ $visitor->id }}')" class="text-gray-500 hover:text-gray-800 text-2xl">&times;</button>
        </div>
        <form action="{{ route('security_officer.updateVisitor', $visitor->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label class="block text-gray-700 font-medium">First Name</label>
                    <input type="text" name="first_name" value="{{ $visitor->first_name }}" required class="w-full p-2 border rounded">
                </div>
                <div>
                    <label class="block text-gray-700 font-medium">Last Name</label>
                    <input type="text" name="last_name" value="{{ $visitor->last_name }}" required class="w-full p-2 border rounded">
                </div>
                <div>
                    <label class="block text-gray-700 font-medium">Phone Number</label>
                    <input type="text" name="phone_number" value="{{ $visitor->phone_number }}" required class="w-full p-2 border rounded">
                </div>
                <div>
                    <label class="block text-gray-700 font-medium">Relationship</label>
                    <input type="text" name="relationship" value="{{ $visitor->relationship }}" required class="w-full p-2 border rounded">
                </div>
                <div>
                    <label class="block text-gray-700 font-medium">Address</label>
                    <input type="text" name="address" value="{{ $visitor->address }}" required class="w-full p-2 border rounded">
                </div>
                <div>
                    <label class="block text-gray-700 font-medium">ID Number</label>
                    <input type="text" name="identification_number" value="{{ $visitor->identification_number }}" required class="w-full p-2 border rounded">
                </div>
                <div>
                    <label class="block text-gray-700 font-medium">Username</label>
                    <input type="text" name="username" value="{{ $visitor->username }}" required class="w-full p-2 border rounded">
                </div>
            </div>

            <div class="mt-6 flex justify-end space-x-3">
                <button type="submit" class="px-5 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Update</button>
                <button type="button" onclick="closeModal('editVisitorModal-{{ $visitor->id }}')" class="px-5 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">Cancel</button>
            </div>
        </form>
    </div>
</div>
@endforeach

                </div>

                <div class="mt-8 text-center">
                    <a href="{{ route('security_officer.registerVisitor') }}"
                        class="inline-block px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300">
                        Register New Visitor
                    </a>
                </div>

            </div>
        </div>
    </div>
    <script>
    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
        document.getElementById(id).classList.add('flex');
    }

    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
        document.getElementById(id).classList.remove('flex');
    }
</script>

    @include('includes.footer_js')
</body>

</html>
