<section class="bg-white rounded-xl shadow-sm p-6 border border-red-200">
    <header class="border-b border-red-200 pb-4 mb-6">
        <div class="flex items-center">
            <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-red-500 to-pink-600 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
            <div class="ml-4">
                <h2 class="text-xl font-bold text-gray-900">
                    Eliminar Cuenta
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Esta acción es permanente y no se puede deshacer
                </p>
            </div>
        </div>
    </header>

    <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
        <div class="flex items-start">
            <svg class="w-5 h-5 text-red-600 mr-3 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            <div>
                <h3 class="text-sm font-semibold text-red-800 mb-1">⚠️ Advertencia importante</h3>
                <p class="text-sm text-red-700">
                    Una vez que tu cuenta sea eliminada, todos tus datos y recursos serán eliminados permanentemente.
                    Antes de eliminar tu cuenta, asegúrate de descargar cualquier información que desees conservar.
                </p>
            </div>
        </div>
    </div>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-red-600 to-pink-600 hover:from-red-700 hover:to-pink-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105"
    >
        <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
        </svg>
        Eliminar mi Cuenta
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <div class="flex items-center mb-4">
                <div class="flex-shrink-0 w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <h2 class="ml-4 text-xl font-bold text-gray-900">
                    ¿Estás seguro de eliminar tu cuenta?
                </h2>
            </div>

            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                <p class="text-sm text-gray-700">
                    Esta acción es <span class="font-bold text-red-600">permanente e irreversible</span>.
                    Todos tus datos, cuentas API y configuraciones serán eliminados definitivamente.
                    Por favor, ingresa tu contraseña para confirmar que deseas eliminar permanentemente tu cuenta.
                </p>
            </div>

            <div class="mb-6">
                <x-input-label for="password" value="Contraseña" class="text-gray-700 font-semibold mb-2" />

                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <x-text-input
                        id="password"
                        name="password"
                        type="password"
                        class="block w-full pl-10 pr-4 py-3 rounded-xl border-gray-300 focus:border-red-500 focus:ring-2 focus:ring-red-500/20"
                        placeholder="Ingresa tu contraseña"
                    />
                </div>

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200">
                <button
                    type="button"
                    x-on:click="$dispatch('close')"
                    class="inline-flex items-center px-6 py-3 bg-white border-2 border-gray-300 hover:border-gray-400 text-gray-700 font-semibold rounded-xl transition-all duration-300 transform hover:scale-105"
                >
                    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Cancelar
                </button>

                <button
                    type="submit"
                    class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-red-600 to-pink-600 hover:from-red-700 hover:to-pink-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105"
                >
                    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    Sí, Eliminar mi Cuenta
                </button>
            </div>
        </form>
    </x-modal>
</section>
