<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('name', 'asc')->paginate(10);
        
        // Hitung statistik di controller
        $totalUsers = User::count();
        $adminCount = User::where('role', 'admin')->count();
        $petugasCount = User::where('role', 'petugas')->count();
        $userCount = User::where('role', 'user')->count();
        
        return view('admin.user.index', compact(
            'users',
            'totalUsers',
            'adminCount',
            'petugasCount',
            'userCount'
        ));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'role' => 'required',
            'password' => 'required|min:8'
        ]);

        User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'role'      => $request->role,
            'password'  => Hash::make($request->password)
        ]);

        return redirect()->route('admin.user.index')
                         ->with('success', 'User berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
{
    $request->validate([
        'name'  => 'required',
        'email' => "required|email|unique:users,email,$user->id",
        'role'  => 'required',
        'password' => 'nullable|min:8|confirmed', // ← MINIMAL 5 KARAKTER
    ]);

    $updateData = [
        'name'  => $request->name,
        'email' => $request->email,
        'role'  => $request->role,
    ];

    if ($request->password) {
        $updateData['password'] = Hash::make($request->password);
    }

    $user->update($updateData);

    return redirect()->route('admin.user.index')
                     ->with('success', 'User berhasil diupdate.');
}

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.user.index')
                         ->with('success', 'User berhasil dihapus.');
    }
}
