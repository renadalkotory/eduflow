<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Category Management</title>

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
                    Category Management
                </h1>

                <p class="text-gray-500">
                    Manage course categories in the E-Learning System
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
        @if(session('success'))
    <div class="mb-6 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg">
        {{ session('success') }}
    </div>
@endif


        <!-- Page Header -->
        <div class="mb-6">

            <h2 class="text-xl font-semibold text-gray-800">
                All Categories
            </h2>

            <p class="text-gray-500 text-sm mt-1">
                {{ $categories->count() }} categories found
            </p>

        </div>


        <!-- Categories Table -->
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
                                Category
                            </th>

                            <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">
                                Description
                            </th>
                            <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">
    Actions
</th>

                        </tr>

                    </thead>


                    <!-- Table Body -->
                    <tbody>

                        @forelse($categories as $category)

                            <tr class="border-t hover:bg-gray-50">


                                <!-- ID -->
                                <td class="px-6 py-4 text-gray-600">

                                    {{ $category->category_id }}

                                </td>


                                <!-- Category Name -->
                                <td class="px-6 py-4">

                                    <div class="font-semibold text-gray-800">

                                        {{ $category->category_name }}

                                    </div>

                                </td>


                                <!-- Description -->
                                <td class="px-6 py-4 text-gray-600">

                                    {{ $category->description ?? 'N/A' }}

                                </td>
                                <td class="px-6 py-4">

    <div class="flex items-center gap-2">

    <!-- Edit -->
    <a
        href="{{ route('admin.categories.edit', $category->category_id) }}"
        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">

        Edit

    </a>


    <!-- Delete -->
    <form
        method="POST"
        action="{{ route('admin.categories.destroy', $category->category_id) }}"
        onsubmit="return confirm('Are you sure you want to delete this category?');">

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
                                    colspan="4"
                                    class="px-6 py-10 text-center text-gray-500">

                                    No categories found.

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
