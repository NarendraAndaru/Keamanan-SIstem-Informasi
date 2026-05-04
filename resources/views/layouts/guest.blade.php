<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Google Fonts: Inter -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Tailwind / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                font-family: 'Inter', sans-serif;
            }
            .glassmorphism {
                background: rgba(255, 255, 255, 0.85);
                backdrop-filter: blur(16px);
                -webkit-backdrop-filter: blur(16px);
                border: 1px solid rgba(255, 255, 255, 0.3);
            }
            .dark .glassmorphism {
                background: rgba(17, 24, 39, 0.85);
                backdrop-filter: blur(16px);
                -webkit-backdrop-filter: blur(16px);
                border: 1px solid rgba(255, 255, 255, 0.08);
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100">
        <!-- Vibrant background gradients -->
        <div class="fixed inset-0 pointer-events-none overflow-hidden select-none z-0">
            <div class="absolute -top-[10%] -left-[10%] w-[50%] h-[50%] bg-indigo-400 dark:bg-indigo-600 rounded-full filter blur-[120px] opacity-20 dark:opacity-30"></div>
            <div class="absolute -bottom-[10%] -right-[10%] w-[50%] h-[50%] bg-purple-400 dark:bg-purple-600 rounded-full filter blur-[120px] opacity-20 dark:opacity-30"></div>
        </div>

        <div class="min-h-screen relative z-10 flex flex-col sm:justify-center items-center pt-6 sm:pt-0 px-4">
            <div class="mb-6 transform hover:scale-105 transition-all duration-300">
                <a href="/" class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-indigo-600 dark:bg-indigo-500 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-500/30 dark:shadow-indigo-500/20">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <span class="text-2xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 dark:from-indigo-400 dark:to-purple-400 bg-clip-text text-transparent tracking-tight">
                        KeamananSI
                    </span>
                </a>
            </div>

            <div class="w-full sm:max-w-md px-8 py-10 glassmorphism shadow-2xl overflow-hidden sm:rounded-3xl transition-all duration-300">
                {{ $slot }}
            </div>

            <!-- Footer / Copyright -->
            <div class="mt-8 text-center text-xs text-slate-500 dark:text-slate-400 select-none">
                &copy; {{ date('Y') }} KeamananSI. All rights reserved.
            </div>
        </div>
    </body>
</html>

