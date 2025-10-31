<section class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
    <header class="border-b border-gray-200 pb-4 mb-6">
        <div class="flex items-center">
            <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
            <div class="ml-4">
                <h2 class="text-xl font-bold text-gray-900">
                    Actualizar Contraseña
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Asegúrate de usar una contraseña segura para proteger tu cuenta
                </p>
            </div>
        </div>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <!-- Current Password -->
        <div class="group">
            <x-input-label for="update_password_current_password" value="Contraseña Actual" class="text-gray-700 font-semibold mb-2 flex items-center">
                <svg class="w-4 h-4 mr-1.5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                </svg>
                Contraseña Actual
            </x-input-label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400 group-hover:text-green-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <x-text-input
                    id="update_password_current_password"
                    name="current_password"
                    type="password"
                    class="block w-full pl-10 pr-4 py-3 rounded-xl border-gray-300 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 transition-all hover:border-green-400"
                    autocomplete="current-password"
                    placeholder="Ingresa tu contraseña actual" />
            </div>
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <!-- New Password -->
        <div class="group">
            <x-input-label for="update_password_password" value="Nueva Contraseña" class="text-gray-700 font-semibold mb-2 flex items-center">
                <svg class="w-4 h-4 mr-1.5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
                Nueva Contraseña
            </x-input-label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400 group-hover:text-green-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <x-text-input
                    id="update_password_password"
                    name="password"
                    type="password"
                    class="block w-full pl-10 pr-4 py-3 rounded-xl border-gray-300 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 transition-all hover:border-green-400"
                    autocomplete="new-password"
                    placeholder="Mínimo 8 caracteres" />
            </div>
            <p class="mt-2 text-xs text-gray-500 flex items-center">
                <svg class="w-3.5 h-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Usa al menos 8 caracteres con mayúsculas, minúsculas y números
            </p>
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="group">
            <x-input-label for="update_password_password_confirmation" value="Confirmar Nueva Contraseña" class="text-gray-700 font-semibold mb-2 flex items-center">
                <svg class="w-4 h-4 mr-1.5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
                Confirmar Nueva Contraseña
            </x-input-label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400 group-hover:text-green-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <x-text-input
                    id="update_password_password_confirmation"
                    name="password_confirmation"
                    type="password"
                    class="block w-full pl-10 pr-4 py-3 rounded-xl border-gray-300 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 transition-all hover:border-green-400"
                    autocomplete="new-password"
                    placeholder="Repite tu nueva contraseña" />
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Botón guardar -->
        <div class="flex items-center gap-4 pt-4 border-t border-gray-200">
            <button type="submit" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                Actualizar Contraseña
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 3000)"
                    class="inline-flex items-center text-sm font-medium text-green-600 bg-green-50 px-4 py-2 rounded-lg"
                >
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    ¡Contraseña actualizada!
                </p>
            @endif
        </div>
    </form>
</section>
