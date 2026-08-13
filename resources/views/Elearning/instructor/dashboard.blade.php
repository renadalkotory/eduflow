<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Instructor Dashboard</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-800">

<div class="min-h-screen flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r border-gray-200 min-h-screen">

        <!-- Logo -->
        <div class="px-6 py-6 border-b border-gray-200">
            <h1 class="text-xl font-bold text-blue-600">
                E-Learning
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Instructor Panel
            </p>
        </div>

        <!-- Navigation -->
        <nav class="p-4 space-y-2">

            <a href="{{ route('instructor.dashboard') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg bg-blue-50 text-blue-600 font-semibold">
                📊
                <span>Dashboard</span>
            </a>

            <a href="{{ route('instructor.manageCourse') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-600 hover:bg-gray-100">
                📚
                <span>My Courses</span>
            </a>

            <a href="{{ route('instructor.students') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-600 hover:bg-gray-100">
                👨‍🎓
                <span>Students</span>
            </a>

            <a href="{{ route('instructor.createQuiz') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-600 hover:bg-gray-100">
                📝
                <span>Quizzes</span>
            </a>

            <a href="{{ route('instructor.gradeTests') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-600 hover:bg-gray-100">
                🎓
                <span>Grades</span>
            </a>

            <a href="{{ route('instructor.profile') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-600 hover:bg-gray-100">
                ⚙️
                <span>Profile</span>
            </a>

        </nav>

    </aside>


    <!-- Main Content -->
    <div class="flex-1">

        <!-- Top Navbar -->
        <nav class="bg-white border-b border-gray-200">

            <div class="px-8 py-4 flex items-center justify-between">

                <div>
                    <h2 class="text-lg font-semibold">
                        Instructor Dashboard
                    </h2>
                </div>

                <div class="flex items-center gap-4">

                    <div class="text-right">
                        <p class="font-semibold">
                            {{ auth()->user()->full_name }}
                        </p>

                        <p class="text-sm text-gray-500">
                            Instructor
                        </p>
                    </div>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf

                        <button
                            type="submit"
                            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm">
                            Logout
                        </button>
                    </form>

                </div>

            </div>

        </nav>


        <!-- Dashboard Content -->
        <main class="p-8">

            <!-- Welcome -->
            <div class="mb-8 flex items-center justify-between">

                <div>
                    <h2 class="text-3xl font-bold text-gray-900">
                        Welcome, {{ auth()->user()->full_name }}!
                    </h2>

                    <p class="text-gray-500 mt-2">
                        Manage your courses and monitor your teaching activity.
                    </p>
                </div>

                <a href="{{ route('instructor.createCourse') }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-lg text-sm font-semibold whitespace-nowrap">
                    + Create New Course
                </a>

            </div>


            <!-- Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

                <div class="bg-white rounded-xl shadow-sm p-6">
                    <p class="text-sm text-gray-500">
                        Total Courses
                    </p>

                    <p class="text-3xl font-bold mt-2">
                        {{ $totalCourses }}
                    </p>
                </div>


                <div class="bg-white rounded-xl shadow-sm p-6">
                    <p class="text-sm text-gray-500">
                        Published Courses
                    </p>

                    <p class="text-3xl font-bold text-green-600 mt-2">
                        {{ $publishedCourses }}
                    </p>
                </div>


                <div class="bg-white rounded-xl shadow-sm p-6">
                    <p class="text-sm text-gray-500">
                        Draft Courses
                    </p>

                    <p class="text-3xl font-bold text-yellow-600 mt-2">
                        {{ $draftCourses }}
                    </p>
                </div>


                <div class="bg-white rounded-xl shadow-sm p-6">
                    <p class="text-sm text-gray-500">
                        Total Views
                    </p>

                    <p class="text-3xl font-bold text-blue-600 mt-2">
                        {{ number_format($totalViews) }}
                    </p>
                </div>

            </div>


            <!-- Recent Courses -->
            <div class="bg-white rounded-xl shadow-sm">

                <div class="px-6 py-5 border-b border-gray-100">

                    <h3 class="text-xl font-bold">
                        Your Recent Courses
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Courses created by you.
                    </p>

                </div>


                @if ($recentCourses->count() > 0)

                    <div class="overflow-x-auto">

                        <table class="w-full">

                            <thead class="bg-gray-50">

                                <tr>

                                    <th class="text-left px-6 py-4 text-sm">
                                        Course
                                    </th>

                                    <th class="text-left px-6 py-4 text-sm">
                                        Price
                                    </th>

                                    <th class="text-left px-6 py-4 text-sm">
                                        Views
                                    </th>

                                    <th class="text-left px-6 py-4 text-sm">
                                        Status
                                    </th>

                                    <th class="text-left px-6 py-4 text-sm">
                                        Created
                                    </th>

                                </tr>

                            </thead>


                            <tbody class="divide-y divide-gray-100">

                                @foreach ($recentCourses as $course)

                                    <tr class="hover:bg-gray-50">

                                        <td class="px-6 py-4">

                                            <p class="font-semibold">
                                                {{ $course->title }}
                                            </p>

                                            <p class="text-sm text-gray-500">
                                                Course #{{ $course->course_id }}
                                            </p>

                                        </td>


                                        <td class="px-6 py-4">

                                            @if ((float) $course->price > 0)

                                                ${{ number_format((float) $course->price, 2) }}

                                            @else

                                                Free

                                            @endif

                                        </td>


                                        <td class="px-6 py-4">
                                            {{ number_format($course->views ?? 0) }}
                                        </td>


                                        <td class="px-6 py-4">

                                            @if ($course->status === 'Published')

                                                <span class="px-3 py-1 rounded-full text-xs bg-green-100 text-green-700">
                                                    Published
                                                </span>

                                            @else

                                                <span class="px-3 py-1 rounded-full text-xs bg-yellow-100 text-yellow-700">
                                                    Draft
                                                </span>

                                            @endif

                                        </td>


                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            {{ $course->created_at->format('M d, Y') }}
                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @else

                    <div class="p-8 text-center text-gray-500">
                        You don't have any courses yet.
                    </div>

                @endif

            </div>

        </main>

    </div>

</div>

</body>
</html>