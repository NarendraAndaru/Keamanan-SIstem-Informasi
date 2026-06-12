<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeadersMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Menambahkan standard HTTP Security Headers
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN'); // Mitigasi Clickjacking
        $response->headers->set('X-Content-Type-Options', 'nosniff'); // Mencegah MIME-sniffing
        $response->headers->set('X-XSS-Protection', '1; mode=block'); // Proteksi XSS warisan browser
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('Permissions-Policy', 'camera=(), microphone=(), geolocation=()'); // Blokir akses sensor
        
        // Basic Content Security Policy (CSP)
        $csp = "default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval'; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com; img-src 'self' data:; frame-ancestors 'none';";

        if (app()->environment('local')) {
            $csp = "default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval' http://127.0.0.1:5173; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com http://127.0.0.1:5173; font-src 'self' https://fonts.gstatic.com; img-src 'self' data:; connect-src 'self' ws://127.0.0.1:5173 http://127.0.0.1:5173; frame-ancestors 'none';";
        }

        $response->headers->set('Content-Security-Policy', $csp);

        return $response;
    }
}
