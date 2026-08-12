<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('user_id', 'desc')->get();

        return view('admin.users.index', compact('users'));
    }

    public function edit($user)
    {
        $user = User::where('user_id', $user)->firstOrFail();

        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $user)
    {
        $user = User::where('user_id', $user)->firstOrFail();

        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email,' . $user->user_id . ',user_id'
            ],

            'phone' => [
                'nullable',
                'string',
                'max:30'
            ],

            'role' => [
                'required',
                'in:admin,instructor,student'
            ],
        ]);

        $user->update($validated);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User updated successfully.');
    }
    public function destroy($user)
{
    $user = User::where('user_id', $user)->firstOrFail();

    $user->delete();

    return redirect()
        ->route('admin.users.index')
        ->with('success', 'User deleted successfully.');
}
}