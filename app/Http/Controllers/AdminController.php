<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ActivityLog;
use App\Enums\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;
use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * Tampilkan Halaman Dashboard Admin.
     */
    public function index(): View
    {
        $users = User::orderBy('name')->get();
        
        // Mengambil log aktivitas terbaru (limit 50)
        $logs = ActivityLog::with('user')->orderBy('created_at', 'desc')->take(50)->get();

        return view('admin.dashboard', compact('users', 'logs'));
    }

    /**
     * Perbarui Role Pengguna (RBAC).
     */
    public function updateRole(Request $request, User $user): RedirectResponse
    {
        // Cegah admin mengubah rolenya sendiri untuk mencegah lockout system
        if ($request->user()->id === $user->id) {
            return back()->with('error', 'Anda tidak dapat mengubah peran Anda sendiri.');
        }

        $validated = $request->validate([
            'role' => ['required', new Enum(Role::class)],
        ]);

        $oldRole = $user->role->value;
        $user->update(['role' => $validated['role']]);

        // Catat ke Activity Log
        ActivityLog::create([
            'user_id' => $request->user()->id,
            'activity' => 'RBAC - Role Updated',
            'description' => "Admin ({$request->user()->email}) mengubah role user {$user->email} dari '{$oldRole}' menjadi '{$validated['role']}'.",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'created_at' => now(),
        ]);

        return back()->with('status', "Peran user {$user->name} berhasil diperbarui menjadi {$validated['role']}.");
    }
}
