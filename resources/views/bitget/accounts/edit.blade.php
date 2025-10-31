<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Editar Cuenta: {{ $account->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow sm:rounded-lg">
                <form action="{{ route('bitget.accounts.update', $account) }}" method="POST" class="p-6 space-y-6">
                    @csrf
                    @method('PATCH')

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nombre de la Cuenta</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $account->name) }}" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="api_key" class="block text-sm font-medium text-gray-700">API Key</label>
                        <input type="text" name="api_key" id="api_key" value="{{ old('api_key', $account->api_key) }}" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 font-mono text-sm">
                        @error('api_key')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="secret_key" class="block text-sm font-medium text-gray-700">Secret Key</label>
                        <input type="password" name="secret_key" id="secret_key" placeholder="Dejar vacío para mantener el actual"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 font-mono text-sm">
                        <p class="mt-1 text-xs text-gray-500">Solo ingresa un nuevo valor si deseas cambiarlo</p>
                        @error('secret_key')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="passphrase" class="block text-sm font-medium text-gray-700">Passphrase</label>
                        <input type="password" name="passphrase" id="passphrase" placeholder="Dejar vacío para mantener el actual"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 font-mono text-sm">
                        <p class="mt-1 text-xs text-gray-500">Solo ingresa un nuevo valor si deseas cambiarlo</p>
                        @error('passphrase')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" name="is_demo" id="is_demo" value="1" {{ old('is_demo', $account->is_demo) ? 'checked' : '' }}
                               class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="is_demo" class="ml-2 block text-sm text-gray-700">
                            Modo demostración
                        </label>
                    </div>

                    <div class="flex items-center justify-end space-x-3">
                        <a href="{{ route('bitget.accounts.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                            Cancelar
                        </a>
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-700">
                            Actualizar Cuenta
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
