<x-guest-layout>
    <!-- Encabezado con ícono -->
    <div class="mb-8 text-center">
        <div class="inline-flex items-center justify-center w-16 h-16 mb-4 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 shadow-lg transform hover:scale-110 transition-transform duration-300">
            <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
            </svg>
        </div>
        <h2 class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent mb-2">
            ¿Olvidaste tu contraseña?
        </h2>
        <p class="text-gray-600">No te preocupes, te ayudaremos a recuperarla</p>
    </div>

    <!-- Descripción mejorada -->
    <div class="mb-6 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-4 border border-indigo-100">
        <p class="text-sm text-gray-700 flex items-start">
            <svg class="w-5 h-5 mr-2 mt-0.5 text-indigo-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>Ingresa tu correo electrónico y te enviaremos un enlace para restablecer tu contraseña.</span>
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div class="group">
            <x-input-label for="email" :value="__('Correo Electrónico')" class="text-gray-700 font-semibold mb-2 flex items-center">
                <svg class="w-4 h-4 mr-1.5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                Correo Electrónico
            </x-input-label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400 group-hover:text-indigo-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <x-text-input
                    id="email"
                    class="block w-full pl-12 pr-4 py-3.5 rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 shadow-sm transition-all duration-200 hover:border-indigo-400"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required
                    autofocus
                    placeholder="tu@email.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Botones -->
        <div class="space-y-3">
            <!-- Botón principal: Enviar enlace -->
            <button type="submit" class="group relative w-full flex justify-center items-center px-6 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-[1.02] overflow-hidden">
                <!-- Efecto de brillo animado -->
                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent transform translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-700"></div>

                <svg class="w-5 h-5 mr-2 relative" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                <span class="relative">Enviar Enlace de Recuperación</span>
            </button>

            <!-- Botón secundario: Regresar al login -->
            <a href="{{ route('login') }}" class="group inline-flex items-center justify-center w-full px-6 py-3.5 border-2 border-gray-200 hover:border-indigo-400 rounded-xl font-semibold text-gray-700 hover:text-indigo-600 bg-white hover:bg-indigo-50 transition-all duration-300 transform hover:scale-[1.02]">
                <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Regresar al Inicio de Sesión
            </a>
        </div>
    </form>

    <!-- Ayuda adicional -->
    <div class="mt-6 pt-6 border-t border-gray-200 text-center">
        <p class="text-sm text-gray-600">
            ¿Necesitas ayuda?
            <a href="mailto:soporte@bitgettrade.com" class="font-semibold text-indigo-600 hover:text-indigo-500 transition-colors">
                Contacta con soporte
            </a>
        </p>
    </div>
</x-guest-layout>
