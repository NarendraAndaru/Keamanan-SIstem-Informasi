<?php

namespace App\Listeners;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Request;

class LogActivityListener
{
    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $activity = 'Unknown';
        $description = '';
        $userId = null;
        $properties = [];

        // Deteksi tipe event dari Laravel
        if ($event instanceof \Illuminate\Auth\Events\Login) {
            $activity = 'Auth - Login Success';
            $description = "User {$event->user->email} berhasil login.";
            $userId = $event->user->id;
        } elseif ($event instanceof \Illuminate\Auth\Events\Failed) {
            $activity = 'Auth - Login Failed';
            $description = "Gagal login menggunakan email: " . ($event->credentials['email'] ?? 'tidak diketahui');
            $properties = ['credentials_email' => $event->credentials['email'] ?? null];
        } elseif ($event instanceof \Illuminate\Auth\Events\Logout) {
            $activity = 'Auth - Logout';
            $description = "User {$event->user->email} berhasil logout.";
            $userId = $event->user->id;
        } elseif ($event instanceof \Illuminate\Auth\Events\Registered) {
            $activity = 'Auth - User Registered';
            $description = "User baru terdaftar: {$event->user->email}.";
            $userId = $event->user->id;
        } elseif ($event instanceof \Illuminate\Auth\Events\PasswordReset) {
            $activity = 'Auth - Password Reset';
            $description = "Password untuk user {$event->user->email} telah di-reset.";
            $userId = $event->user->id;
        }

        ActivityLog::create([
            'user_id' => $userId,
            'activity' => $activity,
            'description' => $description,
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
            'properties' => $properties,
            'created_at' => now(),
        ]);
    }
}
