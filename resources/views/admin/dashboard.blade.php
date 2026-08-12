<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Dashboard</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

<div class="min-h-screen">

    <!-- Header -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <div>
                <h1 class="text-2xl font-bold text-gray-800">
                    Admin Dashboard
                </h1>

                <p class="text-gray-500">
                    E-Learning System Administration
                </p>
            </div>

            <div class="flex items-center gap-4">

                <span class="text-gray-700 font-medium">
                    {{ auth()->user()->full_name }}
                </span>

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
    <main class="max-w-7xl mx-auto px-6 py-8">

        <h2 class="text-xl font-semibold text-gray-800 mb-6">
            System Overview
        </h2>


        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

            <!-- Total Courses -->
            <div class="bg-white rounded-lg shadow p-6">
                <p class="text-gray-500">
                    Total Courses
                </p>

                <p class="text-3xl font-bold text-blue-600 mt-2">
                    {{ $totalCourses }}
                </p>
            </div>


            <!-- Total Students -->
            <div class="bg-white rounded-lg shadow p-6">
                <p class="text-gray-500">
                    Total Students
                </p>

                <p class="text-3xl font-bold text-green-600 mt-2">
                    {{ $totalStudents }}
                </p>
            </div>


            <!-- Total Instructors -->
            <div class="bg-white rounded-lg shadow p-6">
                <p class="text-gray-500">
                    Total Instructors
                </p>

                <p class="text-3xl font-bold text-purple-600 mt-2">
                    {{ $totalInstructors }}
                </p>
            </div>


            <!-- Revenue -->
            <div class="bg-white rounded-lg shadow p-6">
                <p class="text-gray-500">
                    Total Revenue
                </p>

                <p class="text-3xl font-bold text-yellow-600 mt-2">
                    ${{ number_format($totalRevenue, 2) }}
                </p>
            </div>

        </div>


        <!-- Popular Courses -->
        <div class="bg-white rounded-lg shadow mt-8">

            <div class="px-6 py-5 border-b">
                <h2 class="text-lg font-semibold text-gray-800">
                    Popular Courses
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Courses ranked by number of enrollments
                </p>
            </div>


            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-gray-50">

                        <tr>
                            <th class="text-left px-6 py-3 text-sm font-semibold text-gray-600">
                                Course
                            </th>

                            <th class="text-left px-6 py-3 text-sm font-semibold text-gray-600">
                                Price
                            </th>

                            <th class="text-left px-6 py-3 text-sm font-semibold text-gray-600">
                                Views
                            </th>

                            <th class="text-left px-6 py-3 text-sm font-semibold text-gray-600">
                                Enrollments
                            </th>
                        </tr>

                    </thead>


                    <tbody>

                        @forelse($popularCourses as $course)

                            <tr class="border-t">

                                <td class="px-6 py-4 text-gray-800 font-medium">
                                    {{ $course->title }}
                                </td>

                                <td class="px-6 py-4 text-gray-600">
                                    ${{ number_format($course->price, 2) }}
                                </td>

                                <td class="px-6 py-4 text-gray-600">
                                    {{ $course->views }}
                                </td>

                                <td class="px-6 py-4 text-gray-600">
                                    {{ $course->enrollment_count }}
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td
                                    colspan="4"
                                    class="px-6 py-6 text-center text-gray-500">
                                    No courses found.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>
<!-- Management Links -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-8">

    <!-- Course Management -->
    <a
        href="{{ route('admin.courses.index') }}"
        class="bg-white rounded-lg shadow p-6 hover:shadow-md transition">

        <h3 class="text-lg font-semibold text-gray-800">
            Course Management
        </h3>

        <p class="text-gray-500 mt-2">
            Manage all courses
        </p>

    </a>


    <!-- User Management -->
    <a
        href="{{ route('admin.users.index') }}"
        class="bg-white rounded-lg shadow p-6 hover:shadow-md transition">

        <h3 class="text-lg font-semibold text-gray-800">
            User Management
        </h3>

        <p class="text-gray-500 mt-2">
            Manage students and instructors
        </p>

    </a>


    <!-- Category Management -->
    <a
        href="{{ route('admin.categories.index') }}"
        class="bg-white rounded-lg shadow p-6 hover:shadow-md transition">

        <h3 class="text-lg font-semibold text-gray-800">
            Category Management
        </h3>

        <p class="text-gray-500 mt-2">
            Manage course categories
        </p>

    </a>


    <!-- Enrollment Management -->
    <a
        href="{{ route('admin.enrollments.index') }}"
        class="bg-white rounded-lg shadow p-6 hover:shadow-md transition">

        <h3 class="text-lg font-semibold text-gray-800">
            Enrollment Management
        </h3>

        <p class="text-gray-500 mt-2">
            Manage student enrollments
        </p>

    </a>
    <!-- Quiz Management -->
<a
    href="{{ route('admin.quizzes.index') }}"
    class="bg-white rounded-lg shadow p-6 hover:shadow-md transition">

    <h3 class="text-lg font-semibold text-gray-800">
        Quiz Management
    </h3>

    <p class="text-gray-500 mt-2">
        Manage quizzes and assessments
    </p>

</a>
<!-- Question Management -->
<a
    href="{{ route('admin.questions.index') }}"
    class="bg-white rounded-lg shadow p-6 hover:shadow-md transition">

    <h3 class="text-lg font-semibold text-gray-800">
        Question Management
    </h3>

    <p class="text-gray-500 mt-2">
        Manage quiz questions
    </p>

</a>


<!-- Option Management -->
<a
    href="{{ route('admin.options.index') }}"
    class="bg-white rounded-lg shadow p-6 hover:shadow-md transition">

    <h3 class="text-lg font-semibold text-gray-800">
        Option Management
    </h3>

    <p class="text-gray-500 mt-2">
        Manage quiz answer options
    </p>

</a>
<!-- Section Management -->
<a
    href="{{ route('admin.sections.index') }}"
    class="bg-white rounded-lg shadow p-6 hover:shadow-md transition">

    <h3 class="text-lg font-semibold text-gray-800">
        Section Management
    </h3>

    <p class="text-gray-500 mt-2">
        Manage course sections
    </p>

</a>


<!-- Lesson Management -->
<a
    href="{{ route('admin.lessons.index') }}"
    class="bg-white rounded-lg shadow p-6 hover:shadow-md transition">

    <h3 class="text-lg font-semibold text-gray-800">
        Lesson Management
    </h3>

    <p class="text-gray-500 mt-2">
        Manage course lessons
    </p>

</a>

</div>


        <!-- Welcome Section -->
        <div class="bg-white rounded-lg shadow p-6 mt-8">

            <h2 class="text-lg font-semibold text-gray-800">
                Welcome to the Admin Panel
            </h2>

            <p class="text-gray-600 mt-2">
                From this dashboard, you can monitor and manage
                the E-Learning System.
            </p>

        </div>

    </main>

</div>


</body>
</html>