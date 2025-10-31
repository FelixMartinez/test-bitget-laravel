<section class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
    <header class="border-b border-gray-200 pb-4 mb-6">
        <div class="flex items-center">
            <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </div>
            <div class="ml-4">
                <h2 class="text-xl font-bold text-gray-900">
                    Información del Perfil
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Actualiza tu nombre y correo electrónico
                </p>
            </div>
        </div>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <!-- Name -->
        <div class="group">
            <x-input-label for="name" value="Nombre Completo" class="text-gray-700 font-semibold mb-2 flex items-center">
                <svg class="w-4 h-4 mr-1.5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                Nombre Completo
            </x-input-label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400 group-hover:text-indigo-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <x-text-input
                    id="name"
                    name="name"
                    type="text"
                    class="block w-full pl-10 pr-4 py-3 rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all hover:border-indigo-400"
                    :value="old('name', $user->name)"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="Tu nombre completo" />
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- Email -->
        <div class="group">
            <x-input-label for="email" value="Correo Electrónico" class="text-gray-700 font-semibold mb-2 flex items-center">
                <svg class="w-4 h-4 mr-1.5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                Correo Electrónico
            </x-input-label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400 group-hover:text-indigo-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <x-text-input
                    id="email"
                    name="email"
                    type="email"
                    class="block w-full pl-10 pr-4 py-3 rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all hover:border-indigo-400"
                    :value="old('email', $user->email)"
                    required
                    autocomplete="username"
                    placeholder="tu@email.com" />
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3 bg-yellow-50 border border-yellow-200 rounded-lg p-3">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-yellow-600 mr-2 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <div>
                            <p class="text-sm text-yellow-800 font-medium">
                                Tu correo electrónico no está verificado.
                            </p>
                            <button form="send-verification" class="mt-1 text-sm text-yellow-700 hover:text-yellow-900 underline font-semibold">
                                Haz clic aquí para reenviar el correo de verificación
                            </button>
                        </div>
                    </div>

                    @if (session('status') === 'verification-link-sent')
                        <div class="mt-2 flex items-center text-sm text-green-700">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            Se ha enviado un nuevo enlace de verificación a tu correo electrónico.
                        </div>
                    @endif
                </div>
            @endif
        </div>

        <!-- Botón guardar -->
        <div class="flex items-center gap-4 pt-4 border-t border-gray-200">
            <button type="submit" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                Guardar Cambios
            </button>

            @if (session('status') === 'profile-updated')
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
                    ¡Guardado exitosamente!
                </p>
            @endif
        </div>
    </form>
</section>
