<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Security Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-gray-950 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Alert Session Status -->
            @if (session('status'))
                <div class="p-4 bg-emerald-500/15 border border-emerald-500/30 text-emerald-600 dark:text-emerald-400 rounded-lg backdrop-blur-md">
                    {{ session('status') }}
                </div>
            @endif

            @if (session('error'))
                <div class="p-4 bg-rose-500/15 border border-rose-500/30 text-rose-600 dark:text-rose-400 rounded-lg backdrop-blur-md">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Section: RBAC User Management -->
            <div class="bg-white/80 dark:bg-gray-900/80 backdrop-blur-xl border border-gray-200/50 dark:border-gray-800/50 overflow-hidden shadow-xl sm:rounded-2xl transition-all duration-300">
                <div class="p-6 border-b border-gray-200/30 dark:border-gray-800/30">
                    <h3 class="text-lg font-semibold text-gray-950 dark:text-white flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        Role-Based Access Control (RBAC) - User Management
                    </h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Mengelola peran akses pengguna sistem.</p>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-100/50 dark:bg-gray-800/50 text-gray-600 dark:text-gray-400 text-xs font-semibold uppercase tracking-wider">
                                <th class="p-4 border-b border-gray-200/30 dark:border-gray-800/30">Nama</th>
                                <th class="p-4 border-b border-gray-200/30 dark:border-gray-800/30">Email</th>
                                <th class="p-4 border-b border-gray-200/30 dark:border-gray-800/30">Role Sekarang</th>
                                <th class="p-4 border-b border-gray-200/30 dark:border-gray-800/30">Tindakan Ganti Role</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-800 text-sm">
                            @foreach ($users as $user)
                                <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-800/20 transition-colors">
                                    <td class="p-4 text-gray-900 dark:text-gray-100 font-medium">{{ $user->name }}</td>
                                    <td class="p-4 text-gray-600 dark:text-gray-400">{{ $user->email }}</td>
                                    <td class="p-4">
                                        @if ($user->isAdmin())
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 dark:bg-indigo-500/10 text-indigo-800 dark:text-indigo-400 border border-indigo-200/30 dark:border-indigo-500/20">
                                                Admin
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 dark:bg-gray-500/10 text-gray-800 dark:text-gray-400 border border-gray-200/30 dark:border-gray-500/20">
                                                User
                                            </span>
                                        @endif
                                    </td>
                                    <td class="p-4">
                                        <form action="{{ route('admin.users.update-role', $user) }}" method="POST" class="flex items-center gap-2">
                                            @csrf
                                            <select name="role" onchange="this.form.submit()" class="text-xs bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg p-1.5 focus:ring-indigo-500 focus:border-indigo-500 dark:text-gray-200 disabled:opacity-50" @disabled(Auth::user()->id === $user->id)>
                                                <option value="user" @selected($user->role->value === 'user')>Jadikan User</option>
                                                <option value="admin" @selected($user->role->value === 'admin')>Jadikan Admin</option>
                                            </select>
                                            @if (Auth::user()->id === $user->id)
                                                <span class="text-[10px] text-rose-500 font-medium">(Akun Anda)</span>
                                            @endif
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Section: Activity Security Audit Log -->
            <div class="bg-white/80 dark:bg-gray-900/80 backdrop-blur-xl border border-gray-200/50 dark:border-gray-800/50 overflow-hidden shadow-xl sm:rounded-2xl transition-all duration-300">
                <div class="p-6 border-b border-gray-200/30 dark:border-gray-800/30">
                    <h3 class="text-lg font-semibold text-gray-950 dark:text-white flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Security Audit Trail - Activity Logs
                    </h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Audit log keamanan dari sistem autentikasi dan pengelolaan pengguna (50 Log Terakhir).</p>
                </div>
                <div class="overflow-x-auto max-h-[500px] overflow-y-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="sticky top-0 z-10">
                            <tr class="bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 text-xs font-semibold uppercase tracking-wider">
                                <th class="p-4 border-b border-gray-200/30 dark:border-gray-800/30">Waktu</th>
                                <th class="p-4 border-b border-gray-200/30 dark:border-gray-800/30">Aktivitas</th>
                                <th class="p-4 border-b border-gray-200/30 dark:border-gray-800/30">Deskripsi</th>
                                <th class="p-4 border-b border-gray-200/30 dark:border-gray-800/30">IP Address</th>
                                <th class="p-4 border-b border-gray-200/30 dark:border-gray-800/30">User Agent</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-800 text-xs">
                            @forelse ($logs as $log)
                                <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-800/20 transition-colors">
                                    <td class="p-4 text-gray-500 whitespace-nowrap">{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                                    <td class="p-4">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-semibold 
                                            @if (str_contains($log->activity, 'Failed')) bg-rose-100 dark:bg-rose-500/10 text-rose-800 dark:text-rose-400
                                            @elseif (str_contains($log->activity, 'Success')) bg-emerald-100 dark:bg-emerald-500/10 text-emerald-800 dark:text-emerald-400
                                            @elseif (str_contains($log->activity, 'RBAC')) bg-amber-100 dark:bg-amber-500/10 text-amber-800 dark:text-amber-400
                                            @else bg-blue-100 dark:bg-blue-500/10 text-blue-800 dark:text-blue-400 @endif">
                                            {{ $log->activity }}
                                        </span>
                                    </td>
                                    <td class="p-4 text-gray-700 dark:text-gray-300 font-medium">{{ $log->description }}</td>
                                    <td class="p-4 text-gray-500 font-mono">{{ $log->ip_address }}</td>
                                    <td class="p-4 text-gray-400 truncate max-w-xs" title="{{ $log->user_agent }}">{{ $log->user_agent }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-8 text-center text-gray-500 dark:text-gray-400">Belum ada log aktivitas keamanan yang tercatat.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
