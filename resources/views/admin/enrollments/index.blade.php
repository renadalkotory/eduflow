<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Enrollment Management</title>

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
                    Enrollment Management
                </h1>

                <p class="text-gray-500">
                    Manage student course enrollments
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
                All Enrollments
            </h2>

            <p class="text-gray-500 text-sm mt-1">
                {{ $enrollments->count() }} enrollments found
            </p>

        </div>


        <!-- Enrollments Table -->
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
                                Student
                            </th>

                            <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">
                                Course
                            </th>

                            <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">
                                Enrolled At
                            </th>

                            <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">
                                Payment Status
                            </th>

                        </tr>

                    </thead>


                    <!-- Table Body -->
                    <tbody>

                        @forelse($enrollments as $enrollment)

                            <tr class="border-t hover:bg-gray-50">


                                <!-- Enrollment ID -->
                                <td class="px-6 py-4 text-gray-600">

                                    {{ $enrollment->enrollment_id }}

                                </td>


                                <!-- Student -->
                                <td class="px-6 py-4">

                                    <div class="font-semibold text-gray-800">

                                        {{ $enrollment->student_name }}

                                    </div>

                                </td>


                                <!-- Course -->
                                <td class="px-6 py-4 text-gray-700">

                                    {{ $enrollment->course_title }}

                                </td>


                                <!-- Enrolled At -->
                                <td class="px-6 py-4 text-gray-600">

                                    {{ $enrollment->enrolled_at
                                        ? \Carbon\Carbon::parse($enrollment->enrolled_at)->format('M d, Y')
                                        : 'N/A'
                                    }}

                                </td>


                                <!-- Payment Status -->
                                <td class="px-6 py-4">

                                    @if($enrollment->payment_status === 'Paid')

                                        <span class="px-3 py-1 text-sm rounded-full bg-green-100 text-green-700">

                                            Paid

                                        </span>

                                    @else

                                        <span class="px-3 py-1 text-sm rounded-full bg-blue-100 text-blue-700">

                                            Free

                                        </span>

                                    @endif

                                </td>


                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="5"
                                    class="px-6 py-10 text-center text-gray-500">

                                    No enrollments found.

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
