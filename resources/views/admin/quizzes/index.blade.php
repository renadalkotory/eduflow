<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Quiz Management</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

<div class="min-h-screen">

    <!-- Header -->
    <header class="bg-white shadow">

        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <div>

                <h1 class="text-2xl font-bold text-gray-800">
                    Quiz Management
                </h1>

                <p class="text-gray-500">
                    Manage quizzes in the E-Learning System
                </p>

            </div>

            <div class="flex items-center gap-4">

                <a
                    href="{{ route('admin.dashboard') }}"
                    class="text-blue-600 hover:text-blue-800">

                    Dashboard

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


        <!-- Page Header -->
        <div class="mb-6">

            <h2 class="text-xl font-semibold text-gray-800">
                All Quizzes
            </h2>

            <p class="text-gray-500 text-sm mt-1">
                {{ $quizzes->count() }} quizzes found
            </p>

        </div>


        <!-- Quizzes Table -->
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
                                Quiz
                            </th>

                            <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">
                                Course
                            </th>

                            <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">
                                Section
                            </th>

                            <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">
                                Total Marks
                            </th>

                        </tr>

                    </thead>


                    <!-- Table Body -->
                    <tbody>

                        @forelse($quizzes as $quiz)

                            <tr class="border-t hover:bg-gray-50">


                                <!-- ID -->
                                <td class="px-6 py-4 text-gray-600">

                                    {{ $quiz->quiz_id }}

                                </td>


                                <!-- Quiz -->
                                <td class="px-6 py-4">

                                    <div class="font-semibold text-gray-800">

                                        {{ $quiz->quiz_title }}

                                    </div>

                                </td>


                                <!-- Course -->
                                <td class="px-6 py-4 text-gray-700">

                                    {{ $quiz->course_title }}

                                </td>


                                <!-- Section -->
                                <td class="px-6 py-4 text-gray-700">

                                    {{ $quiz->section_title }}

                                </td>


                                <!-- Total Marks -->
                                <td class="px-6 py-4 text-gray-700">

                                    {{ $quiz->total_marks }}

                                </td>


                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="5"
                                    class="px-6 py-10 text-center text-gray-500">

                                    No quizzes found.

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