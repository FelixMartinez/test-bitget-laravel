<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-indigo-600 shadow-sm">
                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <div>
                    <h2 class="font-semibold text-xl text-gray-800">
                        Balance de Bitget
                    </h2>
                    <p class="text-xs text-gray-500">Cuenta Spot</p>
                </div>
            </div>
            <button onclick="refreshBalance()"
                    id="refreshBtn"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow-sm transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
                Actualizar
            </button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <div id="alertContainer"></div>

            @if(isset($hasNoAccount) && $hasNoAccount)
                <!-- Card de Bienvenida con mejor contraste -->
                <div class="bg-gradient-to-br from-indigo-50 via-white to-purple-50 overflow-hidden shadow-xl rounded-2xl border border-indigo-100">
                    <div class="px-6 py-16 sm:px-12 sm:py-20">
                        <div class="text-center max-w-2xl mx-auto">
                            <!-- Icono con fondo circular -->
                            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 shadow-lg mb-6">
                                <svg class="w-10 h-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                </svg>
                            </div>

                            <!-- Título con mejor espaciado -->
                            <h3 class="text-3xl font-bold text-gray-900 mb-4 tracking-tight">
                                ¡Bienvenido a tu Dashboard!
                            </h3>

                            <!-- Descripción con mejor contraste -->
                            <p class="text-lg text-gray-700 mb-3 leading-relaxed">
                                Para comenzar a visualizar tu balance de Bitget, necesitas conectar tu cuenta.
                            </p>

                            <p class="text-sm text-gray-600 mb-8 leading-relaxed">
                                Prepara tu <span class="font-semibold text-gray-800">API Key</span>, <span class="font-semibold text-gray-800">Secret Key</span> y <span class="font-semibold text-gray-800">Passphrase</span> de Bitget
                            </p>

                            <!-- Botón principal con mejor diseño -->
                            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-6">
                                <a href="{{ route('bitget.accounts.create') }}"
                                   class="group inline-flex items-center justify-center px-8 py-4 text-base font-semibold text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                                    <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                    Conectar mi Cuenta Bitget
                                </a>
                            </div>

                            <!-- Link de ayuda -->
                            <div class="pt-4 border-t border-gray-200">
                                <a href="https://www.bitget.com/api-doc/common/intro"
                                   target="_blank"
                                   class="inline-flex items-center text-sm font-medium text-indigo-700 hover:text-indigo-800 transition-colors">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    ¿Cómo obtener mis credenciales de API?
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                @if(str_contains($message ?? '', 'Demo'))
                <div class="mb-6 bg-amber-50 border-l-4 border-amber-400 rounded-r-lg p-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="w-5 h-5 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-semibold text-amber-800">
                                Modo Demostración
                            </h3>
                            <p class="text-sm text-amber-700 mt-1">
                                Estás viendo datos de ejemplo. Configura <code class="bg-amber-200 px-1.5 py-0.5 rounded text-xs font-mono">BITGET_MODE=live</code> en tu archivo .env para ver datos reales.
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow sm:rounded-lg">
                <div class="p-6">

                    @if(!$success)
                        <div class="bg-red-50 border-l-4 border-red-400 rounded-r-lg p-4 mb-6">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-semibold text-red-800">
                                        Error de Conexión
                                    </h3>
                                    <p class="text-sm text-red-700 mt-1">
                                        {{ $message }}
                                    </p>
                                    <p class="text-xs text-red-600 mt-2">
                                        Verifica que tus credenciales de API estén correctamente configuradas en el archivo .env
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="mb-6">
                        <div class="flex items-center justify-between mb-4 pb-4 border-b border-gray-200">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">
                                    Activos Disponibles
                                </h3>
                                <p class="text-sm text-gray-500 mt-1">
                                    Balance de tu cuenta spot en Bitget
                                    @if(isset($activeAccount))
                                        • <span class="font-medium text-indigo-600">{{ $activeAccount->name }}</span>
                                    @endif
                                </p>
                            </div>
                            @if(isset($activeAccount))
                                <a href="{{ route('bitget.accounts.index') }}" class="text-sm text-gray-600 hover:text-indigo-600">
                                    Cambiar cuenta
                                </a>
                            @endif
                        </div>

                        @if($success && count($balances) > 0)
                            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 rounded-lg" id="balanceTable">
                                <table class="min-w-full divide-y divide-gray-300">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-xs font-semibold text-gray-900 sm:pl-6">
                                                Moneda
                                            </th>
                                            <th scope="col" class="px-3 py-3.5 text-left text-xs font-semibold text-gray-900">
                                                Disponible
                                            </th>
                                            <th scope="col" class="px-3 py-3.5 text-left text-xs font-semibold text-gray-900">
                                                Congelado
                                            </th>
                                            <th scope="col" class="px-3 py-3.5 text-left text-xs font-semibold text-gray-900">
                                                Total
                                            </th>
                                            <th scope="col" class="px-3 py-3.5 text-left text-xs font-semibold text-gray-900">
                                                Valor USD
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 bg-white">
                                        @foreach($balances as $balance)
                                            <tr class="hover:bg-gray-50 transition-colors">
                                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                                                    <div class="flex items-center">
                                                        <div class="h-10 w-10 flex-shrink-0">
                                                            <div class="h-10 w-10 rounded-full bg-indigo-600 flex items-center justify-center">
                                                                <span class="text-sm font-semibold text-white">{{ substr($balance['coin'], 0, 1) }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="ml-4">
                                                            <div class="font-semibold text-gray-900">{{ $balance['coin'] }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700">
                                                    {{ $balance['available'] }}
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700">
                                                    {{ $balance['frozen'] }}
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm font-semibold text-gray-900">
                                                    {{ $balance['total'] }}
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm">
                                                    <span class="inline-flex items-center rounded-full bg-green-100 px-3 py-0.5 text-sm font-medium text-green-800">
                                                        {{ $balance['usdValue'] }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-6 bg-gray-50 rounded-lg p-4">
                                <div class="flex items-center justify-between text-sm">
                                    <div class="flex items-center text-gray-600">
                                        <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                        </svg>
                                        <span>Total de activos: <span class="font-semibold text-gray-900">{{ count($balances) }}</span></span>
                                    </div>
                                    <div class="flex items-center text-gray-600">
                                        <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span>Actualizado: <span class="font-semibold text-gray-900" id="lastUpdate">{{ now()->format('d/m/Y H:i:s') }}</span></span>
                                    </div>
                                </div>
                            </div>

                        @elseif($success && count($balances) == 0)
                            <div class="text-center py-16">
                                <!-- Icono con fondo -->
                                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-5">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                    </svg>
                                </div>

                                <h3 class="text-xl font-bold text-gray-900 mb-2">No hay activos disponibles</h3>
                                <p class="text-base text-gray-600 mb-8 max-w-md mx-auto leading-relaxed">
                                    Tu cuenta de Bitget está conectada correctamente, pero no tiene fondos actualmente.
                                </p>

                                <div class="mt-6">
                                    <a href="https://www.bitget.com" target="_blank"
                                       class="inline-flex items-center px-6 py-3 border border-transparent shadow-lg text-base font-semibold rounded-lg text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 transform hover:-translate-y-0.5 transition-all duration-200">
                                        <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                        Depositar en Bitget
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="text-center py-16">
                                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-red-100 mb-5">
                                    <svg class="w-8 h-8 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Error de conexión</h3>
                                <p class="text-base text-gray-600 mb-4">No se pudo conectar con la API de Bitget</p>
                                <p class="text-sm text-gray-500">Verifica que tus credenciales sean correctas</p>
                            </div>
                        @endif
                    </div>

                    <div class="mt-6 bg-blue-50 border-l-4 border-blue-400 p-4 rounded-r-lg">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a.75.75 0 000 1.5h.253a.25.25 0 01.244.304l-.459 2.066A1.75 1.75 0 0010.747 15H11a.75.75 0 000-1.5h-.253a.25.25 0 01-.244-.304l.459-2.066A1.75 1.75 0 009.253 9H9z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-blue-800">
                                    Información sobre tu balance
                                </h3>
                                <div class="mt-2 text-sm text-blue-700">
                                    <ul class="list-disc pl-5 space-y-1">
                                        <li>Los datos provienen directamente de la API de Bitget</li>
                                        <li>Los valores corresponden a tu cuenta Spot</li>
                                        <li>El balance "Congelado" incluye órdenes activas</li>
                                        <li>Usa el botón "Actualizar" para datos recientes</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            @endif
        </div>
    </div>

    <script>
        function refreshBalance() {
            const btn = document.getElementById('refreshBtn');
            const originalText = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '⏳ Actualizando...';

            fetch('{{ route("bitget.refresh") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showAlert('Balance actualizado exitosamente', 'success');
                    updateBalanceTable(data.balances);
                    document.getElementById('lastUpdate').textContent = new Date().toLocaleString('es-ES');
                } else {
                    showAlert(data.message || 'Error al actualizar el balance', 'error');
                }
            })
            .catch(error => {
                showAlert('Error de conexión: ' + error.message, 'error');
            })
            .finally(() => {
                btn.disabled = false;
                btn.innerHTML = originalText;
            });
        }

        function showAlert(message, type) {
            const alertContainer = document.getElementById('alertContainer');
            const alertClass = type === 'success'
                ? 'bg-green-100 border-green-400 text-green-700'
                : 'bg-red-100 border-red-400 text-red-700';

            const alert = `
                <div class="mb-4 ${alertClass} border px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">${message}</span>
                </div>
            `;
            alertContainer.innerHTML = alert;

            setTimeout(() => {
                alertContainer.innerHTML = '';
            }, 5000);
        }

        function updateBalanceTable(balances) {
            if (balances.length === 0) {
                location.reload();
                return;
            }

            const tbody = document.querySelector('#balanceTable tbody');
            if (!tbody) {
                location.reload();
                return;
            }

            tbody.innerHTML = balances.map(balance => `
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">${balance.coin}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">${balance.available}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">${balance.frozen}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-semibold text-gray-900">${balance.total}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-green-600 font-medium">${balance.usdValue}</div>
                    </td>
                </tr>
            `).join('');
        }
    </script>
</x-app-layout>
