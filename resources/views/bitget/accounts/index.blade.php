<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                    Mis Cuentas de Bitget
                </h2>
                <p class="mt-1 text-sm text-gray-600">Gestiona tus conexiones API a Bitget</p>
            </div>
            <a href="{{ route('bitget.accounts.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white text-sm font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Agregar Cuenta
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 bg-gradient-to-r from-emerald-50 to-teal-50 border-l-4 border-emerald-500 p-4 rounded-r-xl shadow-md animate-pulse">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-emerald-500 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-sm font-medium text-emerald-800">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <div class="bg-white/80 backdrop-blur-sm overflow-hidden shadow-xl rounded-2xl border border-gray-200/50">
                <div class="p-8">
                    @if($accounts->count() > 0)
                        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                            @foreach($accounts as $account)
                                <div class="relative group">
                                    <div class="absolute -inset-0.5 bg-gradient-to-r {{ $account->is_active ? 'from-indigo-500 to-purple-600' : 'from-gray-300 to-gray-400' }} rounded-2xl blur opacity-30 group-hover:opacity-60 transition duration-300"></div>
                                    <div class="relative bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 border {{ $account->is_active ? 'border-indigo-200' : 'border-gray-200' }}">
                                        <div class="flex items-start justify-between mb-4">
                                            <div class="flex-1">
                                                <div class="flex items-center space-x-2 mb-2">
                                                    <div class="flex-shrink-0 {{ $account->is_active ? 'bg-gradient-to-br from-indigo-500 to-purple-600' : 'bg-gray-400' }} rounded-lg p-2">
                                                        <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                                        </svg>
                                                    </div>
                                                    <h3 class="font-bold text-gray-900 text-lg">{{ $account->name }}</h3>
                                                </div>
                                                <div class="flex flex-wrap gap-2 mb-3">
                                                    @if($account->is_active)
                                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-emerald-400 to-teal-500 text-white shadow-sm">
                                                            <span class="w-2 h-2 bg-white rounded-full mr-2 animate-pulse"></span>
                                                            Activa
                                                        </span>
                                                    @else
                                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-200 text-gray-700">
                                                            Inactiva
                                                        </span>
                                                    @endif
                                                    @if($account->is_demo)
                                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-amber-400 to-orange-500 text-white shadow-sm">
                                                            Demo
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="space-y-2 mb-4">
                                            <div class="bg-gray-50 rounded-lg p-3">
                                                <p class="text-xs text-gray-500 font-medium mb-1">API Key</p>
                                                <p class="text-sm text-gray-700 font-mono truncate">{{ substr($account->api_key, 0, 20) }}...</p>
                                            </div>
                                            <div class="flex items-center text-xs text-gray-500">
                                                <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                Creada {{ $account->created_at->diffForHumans() }}
                                            </div>
                                        </div>

                                        <div class="flex items-center gap-2 pt-4 border-t border-gray-100">
                                            @if(!$account->is_active)
                                                <form action="{{ route('bitget.accounts.activate', $account) }}" method="POST" class="flex-1">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="w-full inline-flex items-center justify-center px-3 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white text-xs font-semibold rounded-lg shadow-sm transition-all duration-200">
                                                        <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                        </svg>
                                                        Activar
                                                    </button>
                                                </form>
                                            @endif

                                            <a href="{{ route('bitget.accounts.edit', $account) }}" class="flex-1 inline-flex items-center justify-center px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-semibold rounded-lg transition-colors duration-200">
                                                <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                Editar
                                            </a>

                                            <form action="{{ route('bitget.accounts.destroy', $account) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de eliminar esta cuenta?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center justify-center px-3 py-2 bg-red-50 hover:bg-red-100 text-red-600 text-xs font-semibold rounded-lg transition-colors duration-200">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-16">
                            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-full mb-6">
                                <svg class="h-10 w-10 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">No tienes cuentas configuradas</h3>
                            <p class="text-gray-600 mb-8 max-w-md mx-auto">Comienza agregando tu primera cuenta de Bitget para empezar a gestionar tus operaciones.</p>
                            <a href="{{ route('bitget.accounts.create') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                                <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Agregar Primera Cuenta
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
