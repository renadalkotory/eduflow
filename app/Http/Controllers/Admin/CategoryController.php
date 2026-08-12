<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = DB::table('categories')
            ->orderBy('category_id', 'desc')
            ->get();

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:500'],
        ]);

        DB::table('categories')->insert([
            'category_name' => $validated['category_name'],
            'description' => $validated['description'] ?? null,
        ]);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category created successfully.');
    }
    public function edit($category)
{
    $category = DB::table('categories')
        ->where('category_id', $category)
        ->first();

    if (!$category) {
        abort(404);
    }

    return view('admin.categories.edit', compact('category'));
}
public function update(Request $request, $category)
{
    $category = DB::table('categories')
        ->where('category_id', $category)
        ->first();

    if (!$category) {
        abort(404);
    }

    $validated = $request->validate([
        'category_name' => ['required', 'string', 'max:255'],
        'description' => ['nullable', 'string', 'max:500'],
    ]);

    DB::table('categories')
        ->where('category_id', $category->category_id)
        ->update([
            'category_name' => $validated['category_name'],
            'description' => $validated['description'] ?? null,
        ]);

    return redirect()
        ->route('admin.categories.index')
        ->with('success', 'Category updated successfully.');
}
public function destroy($category)
{
    $category = DB::table('categories')
        ->where('category_id', $category)
        ->first();

    if (!$category) {
        abort(404);
    }

    $courseCount = DB::table('courses')
        ->where('category_id', $category->category_id)
        ->count();

    if ($courseCount > 0) {
        return redirect()
            ->route('admin.categories.index')
            ->with('error', 'This category cannot be deleted because it is being used by ' . $courseCount . ' course(s).');
    }

    DB::table('categories')
        ->where('category_id', $category->category_id)
        ->delete();

    return redirect()
        ->route('admin.categories.index')
        ->with('success', 'Category deleted successfully.');
}
}