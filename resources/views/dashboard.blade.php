<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                    ¡Bienvenido, {{ Auth::user()->name }}!
                </h2>
                <p class="mt-1 text-sm text-gray-600">Gestiona tus operaciones de Bitget desde aquí</p>
            </div>
            <div class="flex items-center space-x-2">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                    <span class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></span>
                    En línea
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Tarjetas de estadísticas -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Balance Total -->
                <div class="bg-white/80 backdrop-blur-sm overflow-hidden shadow-lg rounded-2xl border border-gray-200/50 hover:shadow-xl transition-all duration-300 group">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-gradient-to-br from-emerald-400 to-emerald-600 rounded-xl p-3 group-hover:scale-110 transition-transform duration-300">
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                        Balance Total
                                        @if($isDemo)
                                            <span class="ml-1 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-amber-100 text-amber-800">
                                                DEMO
                                            </span>
                                        @endif
                                    </dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-2xl font-bold text-gray-900">
                                            ${{ number_format($totalBalance, 2) }}
                                        </div>
                                        @if($hasBalance && $balanceChange != 0)
                                            <span class="ml-2 text-sm font-medium {{ $balanceChange >= 0 ? 'text-emerald-600' : 'text-red-600' }}">
                                                {{ $balanceChange >= 0 ? '+' : '' }}{{ number_format($balanceChange, 2) }}%
                                            </span>
                                        @endif
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-6 py-3">
                        @if($activeAccount)
                            <a href="{{ route('bitget.balance') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500 flex items-center">
                                Ver detalles
                                <svg class="ml-1 w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        @else
                            <span class="text-sm font-medium text-gray-500">Conecta una cuenta API</span>
                        @endif
                    </div>
                </div>

                <!-- Cuentas Activas -->
                                <!-- Cuentas Registradas -->
                <div class="bg-white/80 backdrop-blur-sm overflow-hidden shadow-lg rounded-2xl border border-gray-200/50 hover:shadow-xl transition-all duration-300 group">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-gradient-to-br from-blue-400 to-blue-600 rounded-xl p-3 group-hover:scale-110 transition-transform duration-300">
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Cuentas API</dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-2xl font-bold text-gray-900">{{ $totalAccounts }}</div>
                                        <div class="ml-2 flex flex-col space-y-1">
                                            @if($realAccounts > 0)
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    {{ $realAccounts }} real{{ $realAccounts > 1 ? 'es' : '' }}
                                                </span>
                                            @endif
                                            @if($demoAccounts > 0)
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                                                    {{ $demoAccounts }} demo
                                                </span>
                                            @endif
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-6 py-3">
                        <a href="{{ route('bitget.accounts.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500 flex items-center">
                            Gestionar cuentas
                            <svg class="ml-1 w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Cuenta Activa -->
                <div class="bg-white/80 backdrop-blur-sm overflow-hidden shadow-lg rounded-2xl border border-gray-200/50 hover:shadow-xl transition-all duration-300 group">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-gradient-to-br from-purple-400 to-purple-600 rounded-xl p-3 group-hover:scale-110 transition-transform duration-300">
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Cuenta Activa</dt>
                                    <dd class="flex items-baseline">
                                        @if($activeAccount)
                                            <div class="text-lg font-bold text-gray-900 truncate" title="{{ $accountName }}">
                                                {{ $accountName }}
                                            </div>
                                        @else
                                            <div class="text-lg font-medium text-gray-400">
                                                Sin cuenta
                                            </div>
                                        @endif
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-6 py-3">
                        @if($activeAccount)
                            <span class="text-sm font-medium text-green-600 flex items-center">
                                <span class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></span>
                                Conectada
                            </span>
                        @else
                            <a href="{{ route('bitget.accounts.create') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                                Conectar cuenta
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Estado de Conexión -->
                <div class="bg-white/80 backdrop-blur-sm overflow-hidden shadow-lg rounded-2xl border border-gray-200/50 hover:shadow-xl transition-all duration-300 group">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-gradient-to-br from-amber-400 to-amber-600 rounded-xl p-3 group-hover:scale-110 transition-transform duration-300">
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Estado API</dt>
                                    <dd class="flex items-baseline">
                                        @if($hasBalance)
                                            <div class="text-lg font-bold text-green-600">
                                                Operativa
                                            </div>
                                        @elseif($activeAccount)
                                            <div class="text-lg font-bold text-amber-600">
                                                Sincronizando
                                            </div>
                                        @else
                                            <div class="text-lg font-bold text-gray-400">
                                                Desconectada
                                            </div>
                                        @endif
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-6 py-3">
                        @if($hasBalance)
                            <span class="text-sm font-medium text-green-600">✓ Datos actualizados</span>
                        @elseif($activeAccount)
                            <span class="text-sm font-medium text-amber-600">Consultando balance...</span>
                        @else
                            <span class="text-sm font-medium text-gray-500">Conecta una cuenta</span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Acciones Rápidas -->
            <div class="bg-white/80 backdrop-blur-sm overflow-hidden shadow-lg rounded-2xl border border-gray-200/50">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        Acciones Rápidas
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <a href="{{ route('bitget.accounts.create') }}" class="flex items-center p-4 bg-gradient-to-r from-indigo-50 to-purple-50 rounded-xl hover:shadow-md transition-all duration-300 group border border-indigo-100">
                            <div class="flex-shrink-0 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg p-2 group-hover:scale-110 transition-transform">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-900">Agregar Cuenta</p>
                                <p class="text-xs text-gray-500">Nueva API de Bitget</p>
                            </div>
                        </a>

                        <a href="{{ route('bitget.balance') }}" class="flex items-center p-4 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl hover:shadow-md transition-all duration-300 group border border-emerald-100">
                            <div class="flex-shrink-0 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-lg p-2 group-hover:scale-110 transition-transform">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-900">Ver Balance</p>
                                <p class="text-xs text-gray-500">Consultar saldos</p>
                            </div>
                        </a>

                        <a href="{{ route('profile.edit') }}" class="flex items-center p-4 bg-gradient-to-r from-amber-50 to-orange-50 rounded-xl hover:shadow-md transition-all duration-300 group border border-amber-100">
                            <div class="flex-shrink-0 bg-gradient-to-br from-amber-500 to-orange-600 rounded-lg p-2 group-hover:scale-110 transition-transform">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-900">Configuración</p>
                                <p class="text-xs text-gray-500">Tu perfil</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Información adicional -->
            @if(!$activeAccount)
                <div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-2xl shadow-xl overflow-hidden">
                    <div class="px-6 py-8 sm:p-10 sm:pb-6">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <h3 class="text-2xl font-bold text-white">Empieza a operar con Bitget</h3>
                                <p class="mt-2 text-indigo-100">Conecta tu cuenta API y comienza a gestionar tus operaciones de forma segura y eficiente.</p>
                            </div>
                            <div class="hidden sm:block">
                                <svg class="w-24 h-24 text-indigo-300 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                        </div>
                        <div class="mt-6">
                            <a href="{{ route('bitget.accounts.create') }}" class="inline-flex items-center px-6 py-3 bg-white text-indigo-600 font-semibold rounded-xl hover:bg-indigo-50 transition-colors duration-200 shadow-lg">
                                Conectar Cuenta API
                                <svg class="ml-2 w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-gradient-to-r from-emerald-500 to-teal-600 rounded-2xl shadow-xl overflow-hidden">
                    <div class="px-6 py-8 sm:p-10 sm:pb-6">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <h3 class="text-2xl font-bold text-white">
                                    ¡Todo listo! 🚀
                                </h3>
                                <p class="mt-2 text-emerald-100">
                                    Tu cuenta <strong>{{ $accountName }}</strong> está conectada y operativa.
                                    @if($hasBalance)
                                        Balance actual: <strong>${{ number_format($totalBalance, 2) }} USDT</strong>
                                    @endif
                                </p>
                                @if($isDemo)
                                    <div class="mt-3 inline-flex items-center px-3 py-1 rounded-lg bg-amber-400 text-amber-900 text-sm font-medium">
                                        <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Estás en modo DEMO - Los datos son simulados
                                    </div>
                                @endif
                            </div>
                            <div class="hidden sm:block">
                                <svg class="w-24 h-24 text-emerald-300 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="mt-6 flex flex-wrap gap-3">
                            <a href="{{ route('bitget.balance') }}" class="inline-flex items-center px-6 py-3 bg-white text-emerald-600 font-semibold rounded-xl hover:bg-emerald-50 transition-colors duration-200 shadow-lg">
                                Ver Balance Completo
                                <svg class="ml-2 w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                            @if($totalAccounts > 1)
                                <a href="{{ route('bitget.accounts.index') }}" class="inline-flex items-center px-6 py-3 bg-emerald-400 text-white font-semibold rounded-xl hover:bg-emerald-500 transition-colors duration-200 shadow-lg">
                                    Cambiar Cuenta
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
