<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.head')
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans antialiased">

    <!-- Navbar -->
    @include('includes.nav')

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        @include('security_officer.menu')

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <div class="max-w-4xl mx-auto bg-white p-8 rounded-2xl shadow-lg">
                <h1 class="text-3xl font-extrabold text-center text-gray-800 mb-8">Visitor Registration</h1>

                <!-- Registration Form -->
                <form action="{{ route('visitor.register.submit') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                        <input type="text" name="first_name" required class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring focus:ring-indigo-200">
                    </div>

                    <div>
                        <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                        <input type="text" name="last_name" required class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring focus:ring-indigo-200">
                    </div>

                    <div>
                        <label for="phone_number" class="block text-sm font-medium text-gray-700">Phone Number</label>
                        <input type="text" name="phone_number" required class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring focus:ring-indigo-200">
                    </div>

                    <div>
                        <label for="relationship" class="block text-sm font-medium text-gray-700">Relationship</label>
                        <input type="text" name="relationship" required class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring focus:ring-indigo-200">
                    </div>

                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                        <input type="text" name="address" required class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring focus:ring-indigo-200">
                    </div>

                    <div>
                        <label for="identification_number" class="block text-sm font-medium text-gray-700">ID Number</label>
                        <input type="text" name="identification_number" required class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring focus:ring-indigo-200">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" required class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring focus:ring-indigo-200">
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" name="password" required class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring focus:ring-indigo-200">
                    </div>

                    <div class="flex justify-end pt-4">
                        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition">Register</button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    @include('includes.footer_js')
</body>

</html>
