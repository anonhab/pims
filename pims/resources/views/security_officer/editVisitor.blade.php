<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.head')
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Edit Visitor</title>
</head>
<body class="bg-gray-100 font-sans">
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Edit Visitor</h2>

        @if (session('success'))
            <div class="bg-green-500 text-white p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow-lg rounded-lg p-6">
            <form action="{{ route('security_officer.updateVisitor', $visitor->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">First Name</label>
                    <input type="text" name="first_name" value="{{ $visitor->first_name }}" required class="w-full p-2 border rounded">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Last Name</label>
                    <input type="text" name="last_name" value="{{ $visitor->last_name }}" required class="w-full p-2 border rounded">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Phone Number</label>
                    <input type="text" name="phone_number" value="{{ $visitor->phone_number }}" required class="w-full p-2 border rounded">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Relationship</label>
                    <input type="text" name="relationship" value="{{ $visitor->relationship }}" required class="w-full p-2 border rounded">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Address</label>
                    <input type="text" name="address" value="{{ $visitor->address }}" required class="w-full p-2 border rounded">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">ID Number</label>
                    <input type="text" name="identification_number" value="{{ $visitor->identification_number }}" required class="w-full p-2 border rounded">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Username</label>
                    <input type="text" name="username" value="{{ $visitor->username }}" required class="w-full p-2 border rounded">
                </div>

                <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300">
                    Update Visitor
                </button>
            </form>
        </div>
    </div>

    @include('includes.footer_js')
</body>
</html>
