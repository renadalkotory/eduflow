<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Course</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

<div class="min-h-screen">

    <!-- Header -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <div>
                <h1 class="text-2xl font-bold text-gray-800">
                    Edit Course
                </h1>

                <p class="text-gray-500">
                    Update course information
                </p>
            </div>

            <div class="flex items-center gap-4">

                <a
                    href="{{ route('admin.courses.index') }}"
                    class="text-blue-600 hover:text-blue-800">
                    Back to Courses
                </a>

                <a
                    href="{{ route('admin.dashboard') }}"
                    class="text-gray-600 hover:text-gray-800">
                    Dashboard
                </a>

            </div>

        </div>
    </header>


    <!-- Main Content -->
    <main class="max-w-4xl mx-auto px-6 py-8">

        <!-- Validation Errors -->
        @if ($errors->any())

            <div class="bg-red-100 border border-red-300 text-red-700 px-5 py-4 rounded-lg mb-6">

                <h3 class="font-semibold mb-2">
                    Please fix the following errors:
                </h3>

                <ul class="list-disc list-inside text-sm">

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        @endif


        <!-- Course Form -->
        <div class="bg-white rounded-lg shadow p-6">

            <form
                method="POST"
                action="{{ route('admin.courses.update', $course->course_id) }}"
                enctype="multipart/form-data">

                @csrf
                @method('PUT')


                <!-- Course Title -->
                <div class="mb-6">

                    <label
                        for="title"
                        class="block text-sm font-semibold text-gray-700 mb-2">
                        Course Title
                    </label>

                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title', $course->title) }}"
                        maxlength="200"
                        required
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">

                </div>


                <!-- Description -->
                <div class="mb-6">

                    <label
                        for="description"
                        class="block text-sm font-semibold text-gray-700 mb-2">
                        Description
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="5"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description', $course->description) }}</textarea>

                </div>


                <!-- Instructor -->
                <div class="mb-6">

                    <label
                        for="instructor_id"
                        class="block text-sm font-semibold text-gray-700 mb-2">
                        Instructor
                    </label>

                    <select
                        id="instructor_id"
                        name="instructor_id"
                        required
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">

                        @foreach($instructors as $instructor)

                            <option
                                value="{{ $instructor->user_id }}"
                                {{ old('instructor_id', $course->instructor_id) == $instructor->user_id ? 'selected' : '' }}>

                                {{ $instructor->full_name }}

                            </option>

                        @endforeach

                    </select>

                </div>


                <!-- Category -->
                <div class="mb-6">

                    <label
                        for="category_id"
                        class="block text-sm font-semibold text-gray-700 mb-2">
                        Category
                    </label>

                    <select
                        id="category_id"
                        name="category_id"
                        required
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">

                        @foreach($categories as $category)

                            <option
                                value="{{ $category->category_id }}"
                                {{ old('category_id', $course->category_id) == $category->category_id ? 'selected' : '' }}>

                                {{ $category->category_name }}

                            </option>

                        @endforeach

                    </select>

                </div>


                <!-- Price -->
                <div class="mb-6">

                    <label
                        for="price"
                        class="block text-sm font-semibold text-gray-700 mb-2">
                        Price
                    </label>

                    <div class="flex items-center">

                        <span class="bg-gray-100 border border-r-0 border-gray-300 px-4 py-3 rounded-l-lg text-gray-600">
                            $
                        </span>

                        <input
                            type="number"
                            id="price"
                            name="price"
                            value="{{ old('price', $course->price) }}"
                            min="0"
                            step="0.01"
                            required
                            class="w-full border border-gray-300 rounded-r-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">

                    </div>

                </div>


                <!-- Current Thumbnail -->
                @if($course->thumbnail)

                    <div class="mb-6">

                        <p class="block text-sm font-semibold text-gray-700 mb-2">
                            Current Thumbnail
                        </p>

                        <img
                            src="{{ asset($course->thumbnail) }}"
                            alt="{{ $course->title }}"
                            class="w-48 h-32 object-cover rounded-lg border">

                    </div>

                @endif


                <!-- New Thumbnail -->
                <div class="mb-6">

                    <label
                        for="thumbnail"
                        class="block text-sm font-semibold text-gray-700 mb-2">
                        Replace Thumbnail
                    </label>

                    <input
                        type="file"
                        id="thumbnail"
                        name="thumbnail"
                        accept="image/jpeg,image/png,image/webp"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 bg-white">

                    <p class="text-sm text-gray-500 mt-1">
                        Leave empty to keep the current thumbnail.
                    </p>

                </div>


                <!-- Status -->
                <div class="mb-8">

                    <label
                        for="status"
                        class="block text-sm font-semibold text-gray-700 mb-2">
                        Status
                    </label>

                    <select
                        id="status"
                        name="status"
                        required
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">

                        <option
                            value="Draft"
                            {{ old('status', $course->status) === 'Draft' ? 'selected' : '' }}>
                            Draft
                        </option>

                        <option
                            value="Published"
                            {{ old('status', $course->status) === 'Published' ? 'selected' : '' }}>
                            Published
                        </option>

                    </select>

                </div>


                <!-- Buttons -->
                <div class="flex justify-end gap-4 mt-6">

                    <a
                        href="{{ route('admin.courses.index') }}"
                        class="px-5 py-3 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">
                        Cancel
                    </a>

                    <button
                        type="submit"
                        style="background-color: #2563eb; color: white; padding: 12px 20px; border-radius: 8px; border: none; cursor: pointer; font-size: 16px;">
                        Update Course
                    </button>

                </div>

            </form>

        </div>

    </main>

</div>

</body>
</html>