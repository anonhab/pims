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
                <h1 class="text-2xl font-bold text-center text-gray-700 mb-6">Visitor Registration</h1>
                
                <form action="{{ route('security_officer.storeVisitor') }}" method="POST" class="space-y-4">
                    @csrf  <!-- Ensure security token is included -->

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="first_name" class="block text-gray-700">First Name</label>
                            <input id="first_name" type="text" name="first_name" placeholder="First Name" required 
                                class="border p-3 rounded w-full focus:ring-2 focus:ring-blue-400">
                        </div>
                        <div>
                            <label for="last_name" class="block text-gray-700">Last Name</label>
                            <input id="last_name" type="text" name="last_name" placeholder="Last Name" required 
                                class="border p-3 rounded w-full focus:ring-2 focus:ring-blue-400">
                        </div>
                    </div>

                    <div>
                        <label for="phone_number" class="block text-gray-700">Phone Number</label>
                        <input id="phone_number" type="text" name="phone_number" placeholder="Phone Number" required 
                            class="border p-3 rounded w-full focus:ring-2 focus:ring-blue-400">
                    </div>

                    <div>
                        <label for="relationship" class="block text-gray-700">Relationship</label>
                        <input id="relationship" type="text" name="relationship" placeholder="Relationship" required 
                            class="border p-3 rounded w-full focus:ring-2 focus:ring-blue-400">
                    </div>

                    <div>
                        <label for="address" class="block text-gray-700">Address</label>
                        <input id="address" type="text" name="address" placeholder="Address" required 
                            class="border p-3 rounded w-full focus:ring-2 focus:ring-blue-400">
                    </div>

                    <div>
                        <label for="identification_number" class="block text-gray-700">ID Number</label>
                        <input id="identification_number" type="text" name="identification_number" placeholder="ID Number" required 
                            class="border p-3 rounded w-full focus:ring-2 focus:ring-blue-400">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="username" class="block text-gray-700">Username</label>
                            <input id="username" type="text" name="username" placeholder="Username" required 
                                class="border p-3 rounded w-full focus:ring-2 focus:ring-blue-400">
                        </div>
                        <div>
                            <label for="password" class="block text-gray-700">Password</label>
                            <input id="password" type="password" name="password" placeholder="Password" required 
                                class="border p-3 rounded w-full focus:ring-2 focus:ring-blue-400">
                        </div>
                    </div>

                    <button type="submit" class="bg-blue-600 text-white py-3 px-6 rounded-lg w-full hover:bg-blue-700 transition duration-300">Register</button>
                </form>

                <!-- Debugging (Remove after testing) -->
                @if(session('success'))
                    <p class="text-green-500 mt-4">{{ session('success') }}</p>
                @endif
                @if($errors->any())
                    <p class="text-red-500 mt-4">{{ implode(', ', $errors->all()) }}</p>
                @endif

            </div>
        </div>
    </div>
    
    @include('includes.footer_js')
</body>
</html>
