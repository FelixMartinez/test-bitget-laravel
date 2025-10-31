<x-guest-layout>
    <!-- Encabezado con gradiente -->
    <div class="mb-8 text-center">
        <div class="inline-flex items-center justify-center w-16 h-16 mb-4 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 shadow-lg transform hover:scale-110 transition-transform duration-300">
            <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
            </svg>
        </div>
        <h2 class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent mb-2">
            Crear Cuenta
        </h2>
        <p class="text-gray-600">Únete a BitgetTrade y comienza a operar</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div class="group">
            <x-input-label for="name" :value="__('Nombre Completo')" class="text-gray-700 font-semibold mb-2 flex items-center">
                <svg class="w-4 h-4 mr-1.5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                Nombre Completo
            </x-input-label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400 group-hover:text-indigo-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <x-text-input
                    id="name"
                    class="block w-full pl-12 pr-4 py-3.5 rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 shadow-sm transition-all duration-200 hover:border-indigo-400"
                    type="text"
                    name="name"
                    :value="old('name')"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="Ingresa tu nombre completo" />
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

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
                    autocomplete="username"
                    placeholder="tu@email.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password con indicador de fortaleza -->
        <div class="group">
            <x-input-label for="password" :value="__('Contraseña')" class="text-gray-700 font-semibold mb-2 flex items-center">
                <svg class="w-4 h-4 mr-1.5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
                Contraseña
            </x-input-label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400 group-hover:text-indigo-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <x-text-input
                    id="password"
                    class="block w-full pl-12 pr-4 py-3.5 rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 shadow-sm transition-all duration-200 hover:border-indigo-400"
                    type="password"
                    name="password"
                    required
                    autocomplete="new-password"
                    placeholder="Mínimo 8 caracteres" />
            </div>
            <!-- Indicadores de requisitos de contraseña -->
            <div class="mt-3 bg-gray-50 rounded-lg p-3 space-y-2" id="password-requirements">
                <p class="text-xs font-semibold text-gray-700 mb-2">La contraseña debe contener:</p>
                <div class="space-y-1.5">
                    <div class="flex items-center text-xs" id="req-length">
                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <circle cx="12" cy="12" r="10" stroke-width="2"/>
                        </svg>
                        <span class="text-gray-600">Al menos 8 caracteres</span>
                    </div>
                    <div class="flex items-center text-xs" id="req-uppercase">
                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <circle cx="12" cy="12" r="10" stroke-width="2"/>
                        </svg>
                        <span class="text-gray-600">Una letra mayúscula</span>
                    </div>
                    <div class="flex items-center text-xs" id="req-lowercase">
                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <circle cx="12" cy="12" r="10" stroke-width="2"/>
                        </svg>
                        <span class="text-gray-600">Una letra minúscula</span>
                    </div>
                    <div class="flex items-center text-xs" id="req-number">
                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <circle cx="12" cy="12" r="10" stroke-width="2"/>
                        </svg>
                        <span class="text-gray-600">Un número</span>
                    </div>
                </div>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="group">
            <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" class="text-gray-700 font-semibold mb-2 flex items-center">
                <svg class="w-4 h-4 mr-1.5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
                Confirmar Contraseña
            </x-input-label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400 group-hover:text-indigo-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <x-text-input
                    id="password_confirmation"
                    class="block w-full pl-12 pr-4 py-3.5 rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 shadow-sm transition-all duration-200 hover:border-indigo-400"
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder="Repite tu contraseña" />
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Términos y condiciones (informativo) -->
        <div class="bg-gradient-to-r from-indigo-50 to-purple-50 rounded-xl p-4 border border-indigo-100">
            <p class="text-xs text-gray-600 flex items-start">
                <svg class="w-4 h-4 mr-2 mt-0.5 text-indigo-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
                <span>Al registrarte, aceptas usar la plataforma de forma responsable y proteger tus credenciales de API.</span>
            </p>
        </div>

        <!-- Botón de registro -->
        <div class="pt-2">
            <button type="submit" class="group relative w-full flex justify-center items-center px-6 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-[1.02] overflow-hidden">
                <!-- Efecto de brillo animado -->
                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent transform translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-700"></div>

                <svg class="w-5 h-5 mr-2 relative" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
                <span class="relative">Crear Cuenta</span>
            </button>
        </div>

        <!-- Divider con texto -->
        <div class="relative py-4">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-200"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-4 bg-white text-gray-500">¿Ya tienes una cuenta?</span>
            </div>
        </div>

        <!-- Login Link mejorado -->
        <div class="text-center">
            <a href="{{ route('login') }}" class="group inline-flex items-center justify-center px-6 py-3 border-2 border-indigo-200 hover:border-indigo-400 rounded-xl font-semibold text-indigo-600 hover:text-indigo-700 bg-white hover:bg-indigo-50 transition-all duration-300 transform hover:scale-105">
                <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                </svg>
                Inicia Sesión
            </a>
        </div>
    </form>

    <!-- Script de validación en tiempo real -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            const passwordConfirmInput = document.getElementById('password_confirmation');

            // Elementos de requisitos
            const reqLength = document.getElementById('req-length');
            const reqUppercase = document.getElementById('req-uppercase');
            const reqLowercase = document.getElementById('req-lowercase');
            const reqNumber = document.getElementById('req-number');

            function updateRequirement(element, isValid) {
                const icon = element.querySelector('svg');
                const text = element.querySelector('span');

                if (isValid) {
                    icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>';
                    icon.classList.remove('text-gray-400');
                    icon.classList.add('text-green-500');
                    text.classList.remove('text-gray-600');
                    text.classList.add('text-green-600', 'font-medium');
                } else {
                    icon.innerHTML = '<circle cx="12" cy="12" r="10" stroke-width="2"/>';
                    icon.classList.remove('text-green-500');
                    icon.classList.add('text-gray-400');
                    text.classList.remove('text-green-600', 'font-medium');
                    text.classList.add('text-gray-600');
                }
            }

            function validatePassword() {
                const password = passwordInput.value;

                // Validar longitud (mínimo 8 caracteres)
                updateRequirement(reqLength, password.length >= 8);

                // Validar mayúscula
                updateRequirement(reqUppercase, /[A-Z]/.test(password));

                // Validar minúscula
                updateRequirement(reqLowercase, /[a-z]/.test(password));

                // Validar número
                updateRequirement(reqNumber, /[0-9]/.test(password));
            }

            function validatePasswordMatch() {
                const password = passwordInput.value;
                const confirmation = passwordConfirmInput.value;

                if (confirmation.length > 0) {
                    if (password === confirmation) {
                        passwordConfirmInput.classList.remove('border-red-300', 'focus:border-red-500', 'focus:ring-red-500/20');
                        passwordConfirmInput.classList.add('border-green-300', 'focus:border-green-500', 'focus:ring-green-500/20');
                    } else {
                        passwordConfirmInput.classList.remove('border-green-300', 'focus:border-green-500', 'focus:ring-green-500/20');
                        passwordConfirmInput.classList.add('border-red-300', 'focus:border-red-500', 'focus:ring-red-500/20');
                    }
                } else {
                    passwordConfirmInput.classList.remove('border-red-300', 'focus:border-red-500', 'focus:ring-red-500/20', 'border-green-300', 'focus:border-green-500', 'focus:ring-green-500/20');
                }
            }

            // Event listeners
            passwordInput.addEventListener('input', validatePassword);
            passwordInput.addEventListener('input', validatePasswordMatch);
            passwordConfirmInput.addEventListener('input', validatePasswordMatch);

            // Validación del nombre (solo letras y espacios)
            const nameInput = document.getElementById('name');
            nameInput.addEventListener('input', function() {
                const value = this.value;
                // Permitir letras (incluyendo acentos), espacios
                const regex = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]*$/;

                if (!regex.test(value)) {
                    this.value = value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, '');
                }

                // Validación visual
                if (this.value.length >= 3) {
                    this.classList.remove('border-red-300');
                    this.classList.add('border-green-300');
                } else if (this.value.length > 0) {
                    this.classList.remove('border-green-300');
                    this.classList.add('border-red-300');
                } else {
                    this.classList.remove('border-red-300', 'border-green-300');
                }
            });

            // Validación del email
            const emailInput = document.getElementById('email');
            emailInput.addEventListener('blur', function() {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                if (this.value.length > 0) {
                    if (emailRegex.test(this.value)) {
                        this.classList.remove('border-red-300');
                        this.classList.add('border-green-300');
                    } else {
                        this.classList.remove('border-green-300');
                        this.classList.add('border-red-300');
                    }
                } else {
                    this.classList.remove('border-red-300', 'border-green-300');
                }
            });
        });
    </script>
</x-guest-layout>
