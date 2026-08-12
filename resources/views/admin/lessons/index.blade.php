<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Lesson Management</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

<div class="min-h-screen">

    <!-- Header -->
    <header class="bg-white shadow">

        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <div>

                <h1 class="text-2xl font-bold text-gray-800">
                    Lesson Management
                </h1>

                <p class="text-gray-500">
                    Manage course lessons in the E-Learning System
                </p>

            </div>

            <div class="flex items-center gap-4">

                <a
                    href="{{ route('admin.dashboard') }}"
                    class="text-blue-600 hover:text-blue-800">

                    Dashboard

                </a>

                <a
                    href="{{ route('admin.sections.index') }}"
                    class="text-blue-600 hover:text-blue-800">

                    Sections

                </a>

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

        <div class="mb-6">

            <h2 class="text-xl font-semibold text-gray-800">
                All Lessons
            </h2>

            <p class="text-gray-500 text-sm mt-1">
                {{ $lessons->count() }} lessons found
            </p>

        </div>


        <!-- Lessons Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-gray-50">

                        <tr>

                            <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">
                                ID
                            </th>

                            <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">
                                Lesson
                            </th>

                            <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">
                                Course
                            </th>

                            <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">
                                Section
                            </th>

                            <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">
                                Duration
                            </th>

                            <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">
                                Order
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($lessons as $lesson)

                            <tr class="border-t hover:bg-gray-50">

                                <td class="px-6 py-4 text-gray-600">
                                    {{ $lesson->lesson_id }}
                                </td>

                                <td class="px-6 py-4">

                                    <div class="font-semibold text-gray-800">
                                        {{ $lesson->lesson_title }}
                                    </div>

                                </td>

                                <td class="px-6 py-4 text-gray-700">
                                    {{ $lesson->course_title }}
                                </td>

                                <td class="px-6 py-4 text-gray-700">
                                    {{ $lesson->section_title }}
                                </td>

                                <td class="px-6 py-4 text-gray-700">
                                    {{ $lesson->duration }}
                                </td>

                                <td class="px-6 py-4 text-gray-700">
                                    {{ $lesson->lesson_order }}
                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="6"
                                    class="px-6 py-10 text-center text-gray-500">

                                    No lessons found.

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