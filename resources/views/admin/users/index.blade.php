<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>User Management</title>

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
                    User Management
                </h1>

                <p class="text-gray-500">
                    Manage all users in the E-Learning System
                </p>

            </div>


            <div class="flex items-center gap-4">

                <!-- Dashboard -->
                <a
                    href="{{ route('admin.dashboard') }}"
                    class="text-blue-600 hover:text-blue-800">

                    Dashboard

                </a>


                <!-- Logout -->
                <form
                    method="POST"
                    action="{{ route('logout') }}">

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
    <main class="max-w-7xl mx-auto px-6 py-8">


        <!-- Page Header -->
        <div class="mb-6">

            <h2 class="text-xl font-semibold text-gray-800">
                All Users
            </h2>

            <p class="text-gray-500 text-sm mt-1">
                {{ $users->count() }} users found
            </p>

        </div>


        <!-- Success Message -->
        @if(session('success'))

            <div class="mb-6 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded">

                {{ session('success') }}

            </div>

        @endif


        <!-- Users Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">

            <div class="overflow-x-auto">

                <table class="w-full">


                    <!-- Table Header -->
                    <thead class="bg-gray-50">

                        <tr>

                            <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">
                                ID
                            </th>

                            <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">
                                User
                            </th>

                            <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">
                                Email
                            </th>

                            <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">
                                Phone
                            </th>

                            <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">
                                Role
                            </th>

                            <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">
                                Created
                            </th>

                            <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">
                                Actions
                            </th>

                        </tr>

                    </thead>


                    <!-- Table Body -->
                    <tbody>

                        @forelse($users as $user)

                            <tr class="border-t hover:bg-gray-50">


                                <!-- ID -->
                                <td class="px-6 py-4 text-gray-600">

                                    {{ $user->user_id }}

                                </td>


                                <!-- User -->
                                <td class="px-6 py-4">

                                    <div class="font-semibold text-gray-800">

                                        {{ $user->full_name }}

                                    </div>

                                </td>


                                <!-- Email -->
                                <td class="px-6 py-4 text-gray-700">

                                    {{ $user->email }}

                                </td>


                                <!-- Phone -->
                                <td class="px-6 py-4 text-gray-700">

                                    {{ $user->phone ?? 'N/A' }}

                                </td>


                                <!-- Role -->
                                <td class="px-6 py-4">

                                    @if($user->role === 'admin')

                                        <span class="px-3 py-1 text-sm rounded-full bg-red-100 text-red-700">

                                            Admin

                                        </span>

                                    @elseif($user->role === 'instructor')

                                        <span class="px-3 py-1 text-sm rounded-full bg-blue-100 text-blue-700">

                                            Instructor

                                        </span>

                                    @else

                                        <span class="px-3 py-1 text-sm rounded-full bg-green-100 text-green-700">

                                            Student

                                        </span>

                                    @endif

                                </td>


                                <!-- Created -->
                                <td class="px-6 py-4 text-gray-600">

                                    {{ $user->created_at
                                        ? \Carbon\Carbon::parse($user->created_at)->format('M d, Y')
                                        : 'N/A'
                                    }}

                               <td class="px-6 py-4">

    <div class="flex items-center gap-2">

        <!-- Edit -->
        <a
            href="{{ route('admin.users.edit', $user->user_id) }}"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">

            Edit

        </a>


        <!-- Delete -->
        <form
            method="POST"
            action="{{ route('admin.users.destroy', $user->user_id) }}"
            onsubmit="return confirm('Are you sure you want to delete this user?');">

            @csrf
            @method('DELETE')

            <button
                type="submit"
                class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">

                Delete

            </button>

        </form>

    </div>

</td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="7"
                                    class="px-6 py-10 text-center text-gray-500">

                                    No users found.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </main>

</div>

</body>
</html>
