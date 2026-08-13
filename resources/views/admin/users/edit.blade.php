<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit User</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="min-h-screen">

    <!-- Header -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <a href="{{ route('home') }}" class="text-xl font-bold text-blue-600 no-underline">EduFlow</a>

            <div>
                <h1 class="text-2xl font-bold text-gray-800">
                    Edit User
                </h1>

                <p class="text-gray-500">
                    Update user information
                </p>
            </div>

            <div class="flex items-center gap-4">

                <a
                    href="{{ route('admin.users.index') }}"
                    class="text-blue-600 hover:text-blue-800">
                    Back to Users
                </a>

                <a
                    href="{{ route('admin.dashboard') }}"
                    class="text-blue-600 hover:text-blue-800">
                    Dashboard
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button
                        type="submit"
                        class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                        Logout
                    </button>
                </form>

            </div>

        </div>
    </header>


    <!-- Main Content -->
    <main class="max-w-3xl mx-auto px-6 py-8">

        <div class="bg-white rounded-lg shadow p-8">

            <h2 class="text-xl font-semibold text-gray-800 mb-6">
                User Information
            </h2>


            <!-- Validation Errors -->
            @if($errors->any())

                <div class="mb-6 bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded">

                    <ul class="list-disc list-inside">

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <!-- Edit Form -->
            <form
                method="POST"
                action="{{ route('admin.users.update', $user->user_id) }}">

                @csrf
                @method('PUT')


                <!-- Full Name -->
                <div class="mb-5">

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Full Name
                    </label>

                    <input
                        type="text"
                        name="full_name"
                        value="{{ old('full_name', $user->full_name) }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>

                </div>


                <!-- Email -->
                <div class="mb-5">

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email', $user->email) }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>

                </div>


                <!-- Phone -->
                <div class="mb-5">

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Phone
                    </label>

                    <input
                        type="text"
                        name="phone"
                        value="{{ old('phone', $user->phone) }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">

                </div>


                <!-- Role -->
                <div class="mb-8">

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Role
                    </label>

                    <select
                        name="role"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>

                        <option
                            value="student"
                            {{ old('role', $user->role) === 'student' ? 'selected' : '' }}>
                            Student
                        </option>

                        <option
                            value="instructor"
                            {{ old('role', $user->role) === 'instructor' ? 'selected' : '' }}>
                            Instructor
                        </option>

                        <option
                            value="admin"
                            {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>
                            Admin
                        </option>

                    </select>

                </div>


                <!-- Buttons -->
                <div class="flex justify-end gap-3">

                    <a
                        href="{{ route('admin.users.index') }}"
                        class="bg-gray-200 text-gray-700 px-5 py-3 rounded-lg hover:bg-gray-300">
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="bg-blue-600 text-white px-5 py-3 rounded-lg hover:bg-blue-700">
                        Update User
                    </button>

                </div>

            </form>

        </div>

    </main>

</div>

</body>
</html>
