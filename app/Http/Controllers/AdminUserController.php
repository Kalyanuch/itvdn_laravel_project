<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditUserRequest;
use App\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $this->authorize('view', User::class);

        $users = User::paginate();

        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(EditUserRequest $request, User $user)
    {
        $this->authorize('update', User::class);

        $user->update([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'is_admin' => (bool)$request->is_admin ?? false,
            'is_manager' => (bool)$request->is_manager ?? false,
        ]);

        return redirect()->route('admin.users.index');
    }

    public function delete(User $user)
    {
        $this->authorize('delete', User::class);

        $user->delete();

        return redirect()->route('admin.users.index');
    }
}
