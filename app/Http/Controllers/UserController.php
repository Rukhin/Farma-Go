<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Only admins can access this controller
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            abort_if(!$request->user()?->isAdmin(), 403);
            return $next($request);
        });
    }

    /**
     * Display list of staff users
     */
    public function index()
    {
        // Only list staff (kasir) for management by admin
        $users = User::where('role', User::ROLE_STAFF)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('users.index', compact('users'));
    }

    /**
     * Show form to create new user
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store new user to database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', Password::min(8)->numbers()->symbols()],
        ]);

        $validated['password'] = bcrypt($validated['password']);
        // Force role to staff (kasir)
        $validated['role'] = User::ROLE_STAFF;

        User::create($validated);

        return redirect()->route('users.index')->with('success', 'User kasir berhasil ditambahkan.');
    }

    /**
     * Show form to edit user
     */
    public function edit(User $user)
    {
        // Admins can edit any user; ensure current user is allowed via controller middleware
        return view('users.edit', compact('user'));
    }

    /**
     * Update user data
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,{$user->id}",
        ]);

        // Ensure we only update name/email for staff. Role must remain staff.
        if ($user->isAdmin()) {
            // Should not happen because admins are not listed, but protect anyway
            return redirect()->back()->withErrors(['user' => 'Tidak dapat mengedit akun admin melalui halaman ini.']);
        }

        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'User kasir berhasil diperbarui.');
    }

    /**
     * Delete user
     */
    public function destroy(User $user)
    {
        // Prevent deleting yourself
        abort_if($user->id === auth()->id(), 403);

        // Disallow deleting admin from kasir management
        abort_if($user->isAdmin(), 403);

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User kasir berhasil dihapus.');
    }

    /**
     * Reset user password (admin only)
     */
    public function resetPassword(Request $request, User $user)
    {
        $validated = $request->validate([
            'password' => ['required', Password::min(8)->numbers()->symbols()],
        ]);

        $user->update(['password' => bcrypt($validated['password'])]);

        return redirect()->route('users.index')->with('success', 'Password user berhasil direset.');
    }
}
