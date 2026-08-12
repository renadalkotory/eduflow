<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Course Management</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

<div class="min-h-screen">

    <!-- Header -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <div>
                <h1 class="text-2xl font-bold text-gray-800">
                    Course Management
                </h1>

                <p class="text-gray-500">
                    Manage all courses in the E-Learning System
                </p>
            </div>

            <div class="flex items-center gap-4">

                <a
                    href="{{ route('admin.dashboard') }}"
                    class="text-blue-600 hover:text-blue-800">
                    Dashboard
                </a>

                <a
                    href="{{ route('admin.courses.create') }}"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    + Create Course
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
    <main class="max-w-7xl mx-auto px-6 py-8">

        <!-- Success Message -->
        @if(session('success'))

            <div class="mb-6 bg-green-100 border border-green-300 text-green-700 px-5 py-4 rounded-lg">
                {{ session('success') }}
            </div>

        @endif


        <!-- Page Header -->
        <div class="flex justify-between items-center mb-6">

            <div>

                <h2 class="text-xl font-semibold text-gray-800">
                    All Courses
                </h2>

                <p class="text-gray-500 text-sm mt-1">
                    {{ $courses->count() }} courses found
                </p>

            </div>

        </div>


        <!-- Courses Table -->
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
                                Course
                            </th>

                            <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">
                                Price
                            </th>

                            <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">
                                Views
                            </th>

                            <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">
                                Status
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

                        @forelse($courses as $course)

                            <tr class="border-t hover:bg-gray-50">

                                <!-- ID -->
                                <td class="px-6 py-4 text-gray-600">
                                    {{ $course->course_id }}
                                </td>


                                <!-- Course -->
                                <td class="px-6 py-4">

                                    <div class="font-semibold text-gray-800">
                                        {{ $course->title }}
                                    </div>

                                    @if($course->description)

                                        <div class="text-sm text-gray-500 mt-1">
                                            {{ Str::limit($course->description, 60) }}
                                        </div>

                                    @endif

                                </td>


                                <!-- Price -->
                                <td class="px-6 py-4 text-gray-700">

                                    @if($course->price > 0)

                                        ${{ number_format($course->price, 2) }}

                                    @else

                                        Free

                                    @endif

                                </td>


                                <!-- Views -->
                                <td class="px-6 py-4 text-gray-700">
                                    {{ number_format($course->views) }}
                                </td>


                                <!-- Status -->
                                <td class="px-6 py-4">

                                    @if($course->status === 'Published')

                                        <span class="px-3 py-1 text-sm rounded-full bg-green-100 text-green-700">
                                            Published
                                        </span>

                                    @else

                                        <span class="px-3 py-1 text-sm rounded-full bg-yellow-100 text-yellow-700">
                                            Draft
                                        </span>

                                    @endif

                                </td>


                                <!-- Created -->
                                <td class="px-6 py-4 text-gray-600">

                                    {{ $course->created_at
                                        ? \Carbon\Carbon::parse($course->created_at)->format('M d, Y')
                                        : 'N/A'
                                    }}

                                </td>


                                <!-- Actions -->
                                <td class="px-6 py-4">

                                    <div class="flex items-center gap-2">

                                        <!-- Edit -->
                                        <a
                                            href="{{ route('admin.courses.edit', $course->course_id) }}"
                                            class="px-3 py-2 rounded bg-blue-600 text-white text-sm hover:bg-blue-700">
                                            Edit
                                        </a>


                                        <!-- Delete -->
                                        <form
                                            method="POST"
                                            action="{{ route('admin.courses.destroy', $course->course_id) }}"
                                            onsubmit="return confirm('Are you sure you want to delete this course?');">

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="px-3 py-2 rounded bg-red-600 text-white text-sm hover:bg-red-700">
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

                                    No courses found.

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