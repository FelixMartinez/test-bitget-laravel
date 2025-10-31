<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                Agregar Cuenta de Bitget
            </h2>
            <p class="mt-1 text-sm text-gray-600">Conecta una nueva cuenta API a tu dashboard</p>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/80 backdrop-blur-sm overflow-hidden shadow-xl rounded-2xl border border-gray-200/50">
                <form action="{{ route('bitget.accounts.store') }}" method="POST" class="p-8 space-y-6">
                    @csrf

                    <!-- Nombre de la Cuenta -->
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nombre de la Cuenta
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                            </div>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                   class="block w-full pl-10 pr-4 py-3 rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/50 transition-all duration-200"
                                   placeholder="Ej: Mi cuenta principal">
                        </div>
                        @error('name')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- API Key -->
                    <div>
                        <label for="api_key" class="block text-sm font-semibold text-gray-700 mb-2">
                            API Key
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                </svg>
                            </div>
                            <input type="text" name="api_key" id="api_key" value="{{ old('api_key') }}" required
                                   class="block w-full pl-10 pr-4 py-3 rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/50 font-mono text-sm transition-all duration-200"
                                   placeholder="bg_...">
                        </div>
                        @error('api_key')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Secret Key -->
                    <div>
                        <label for="secret_key" class="block text-sm font-semibold text-gray-700 mb-2">
                            Secret Key
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input type="password" name="secret_key" id="secret_key" required
                                   class="block w-full pl-10 pr-4 py-3 rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/50 font-mono text-sm transition-all duration-200"
                                   placeholder="••••••••••••••••">
                        </div>
                        @error('secret_key')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Passphrase -->
                    <div>
                        <label for="passphrase" class="block text-sm font-semibold text-gray-700 mb-2">
                            Passphrase
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                            <input type="password" name="passphrase" id="passphrase" required
                                   class="block w-full pl-10 pr-4 py-3 rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/50 font-mono text-sm transition-all duration-200"
                                   placeholder="••••••••">
                        </div>
                        @error('passphrase')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Modo Demo -->
                    <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                        <div class="flex items-center">
                            <input type="checkbox" name="is_demo" id="is_demo" value="1" {{ old('is_demo') ? 'checked' : '' }}
                                   class="h-5 w-5 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded cursor-pointer transition-all">
                            <label for="is_demo" class="ml-3 flex items-center text-sm cursor-pointer">
                                <svg class="w-5 h-5 text-amber-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                                <span class="font-medium text-gray-900">Modo demostración</span>
                                <span class="ml-2 text-gray-500">(sin consultar API real)</span>
                            </label>
                        </div>
                    </div>

                    <!-- Información -->
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border-l-4 border-indigo-400 p-5 rounded-r-xl">
                        <div class="flex">
                            <svg class="h-6 w-6 text-indigo-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a.75.75 0 000 1.5h.253a.25.25 0 01.244.304l-.459 2.066A1.75 1.75 0 0010.747 15H11a.75.75 0 000-1.5h-.253a.25.25 0 01-.244-.304l.459-2.066A1.75 1.75 0 009.253 9H9z" clip-rule="evenodd"/>
                            </svg>
                            <div class="ml-4">
                                <h3 class="text-sm font-semibold text-indigo-900 mb-2">¿Dónde obtengo mis credenciales?</h3>
                                <p class="text-sm text-indigo-800 mb-3">
                                    Obtén tus credenciales API desde tu cuenta de Bitget:
                                </p>
                                <a href="https://www.bitget.com/api-doc" target="_blank" class="inline-flex items-center px-4 py-2 bg-white rounded-lg shadow-sm text-sm font-medium text-indigo-700 hover:bg-indigo-50 transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                    Ir a Documentación API
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Botones -->
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                        <a href="{{ route('bitget.accounts.index') }}" class="px-6 py-3 text-sm font-semibold text-gray-700 bg-white border-2 border-gray-300 rounded-xl hover:bg-gray-50 hover:border-gray-400 transition-all duration-200">
                            Cancelar
                        </a>
                        <button type="submit" class="inline-flex items-center px-6 py-3 text-sm font-semibold text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                            <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Guardar Cuenta
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
