<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50">
            <!-- Logo y branding -->
            <div class="mb-6">
                <a href="/" class="flex items-center space-x-3 group">
                    <div class="bg-gradient-to-br from-indigo-600 to-purple-600 rounded-2xl p-3 shadow-2xl group-hover:shadow-indigo-500/50 transition-all duration-300 group-hover:scale-110">
                        <svg class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <div>
                        <span class="text-2xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">BitgetTrade</span>
                        <p class="text-xs text-gray-600">Trading Platform</p>
                    </div>
                </a>
            </div>

            <!-- Contenedor del formulario -->
            <div class="w-full sm:max-w-md">
                <div class="relative">
                    <!-- Efecto de brillo -->
                    <div class="absolute -inset-1 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-2xl blur-lg opacity-25"></div>

                    <!-- Card principal -->
                    <div class="relative bg-white/90 backdrop-blur-xl px-8 py-10 shadow-2xl overflow-hidden rounded-2xl border border-gray-200/50">
                        {{ $slot }}
                    </div>
                </div>

                <!-- Links adicionales -->
                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        © {{ date('Y') }} BitgetTrade. Todos los derechos reservados.
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>
