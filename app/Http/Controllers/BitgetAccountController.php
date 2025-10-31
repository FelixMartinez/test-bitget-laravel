<?php

namespace App\Http\Controllers;

use App\Models\BitgetAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BitgetAccountController extends Controller
{
    public function index()
    {
        $accounts = Auth::user()->bitgetAccounts()->latest()->get();
        return view('bitget.accounts.index', compact('accounts'));
    }

    public function create()
    {
        return view('bitget.accounts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'min:3', 'regex:/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ\s\-_]+$/'],
            'api_key' => ['required', 'string', 'max:500', 'regex:/^bg_[a-zA-Z0-9]+$/'],
            'secret_key' => ['required', 'string', 'min:32', 'max:1000', 'regex:/^[a-fA-F0-9]+$/'],
            'passphrase' => ['required', 'string', 'min:6', 'max:100'],
            'is_demo' => 'boolean',
        ], [
            'name.required' => 'El nombre de la cuenta es obligatorio.',
            'name.min' => 'El nombre debe tener al menos 3 caracteres.',
            'name.max' => 'El nombre no puede exceder los 255 caracteres.',
            'name.regex' => 'El nombre solo puede contener letras, números, espacios, guiones y guiones bajos.',

            'api_key.required' => 'La API Key es obligatoria.',
            'api_key.regex' => 'La API Key debe comenzar con "bg_" y contener solo caracteres alfanuméricos.',
            'api_key.max' => 'La API Key no puede exceder los 500 caracteres.',

            'secret_key.required' => 'La Secret Key es obligatoria.',
            'secret_key.min' => 'La Secret Key debe tener al menos 32 caracteres.',
            'secret_key.max' => 'La Secret Key no puede exceder los 1000 caracteres.',
            'secret_key.regex' => 'La Secret Key debe contener solo caracteres hexadecimales.',

            'passphrase.required' => 'El Passphrase es obligatorio.',
            'passphrase.min' => 'El Passphrase debe tener al menos 6 caracteres.',
            'passphrase.max' => 'El Passphrase no puede exceder los 100 caracteres.',
        ]);

        // Sanitización adicional
        $validated['name'] = strip_tags(trim($validated['name']));
        $validated['api_key'] = trim($validated['api_key']);
        $validated['secret_key'] = trim($validated['secret_key']);
        $validated['passphrase'] = trim($validated['passphrase']);

        $validated['user_id'] = Auth::id();
        $validated['is_demo'] = $request->has('is_demo');

        // Si es la primera cuenta, activarla automáticamente
        $validated['is_active'] = Auth::user()->bitgetAccounts()->count() === 0;

        BitgetAccount::create($validated);

        return redirect()->route('bitget.accounts.index')
            ->with('success', '¡Cuenta de Bitget agregada exitosamente!');
    }

    public function edit(BitgetAccount $account)
    {
        if ($account->user_id !== Auth::id()) {
            abort(403);
        }
        return view('bitget.accounts.edit', compact('account'));
    }

    public function update(Request $request, BitgetAccount $account)
    {
        // Autorización: verificar que el usuario sea dueño de la cuenta
        if ($account->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para editar esta cuenta.');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'min:3', 'regex:/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ\s\-_]+$/'],
            'api_key' => ['required', 'string', 'max:500', 'regex:/^bg_[a-zA-Z0-9]+$/'],
            'secret_key' => ['nullable', 'string', 'min:32', 'max:1000', 'regex:/^[a-fA-F0-9]+$/'],
            'passphrase' => ['nullable', 'string', 'min:6', 'max:100'],
            'is_demo' => 'boolean',
        ], [
            'name.required' => 'El nombre de la cuenta es obligatorio.',
            'name.min' => 'El nombre debe tener al menos 3 caracteres.',
            'name.regex' => 'El nombre solo puede contener letras, números, espacios, guiones y guiones bajos.',

            'api_key.required' => 'La API Key es obligatoria.',
            'api_key.regex' => 'La API Key debe comenzar con "bg_" y contener solo caracteres alfanuméricos.',

            'secret_key.min' => 'La Secret Key debe tener al menos 32 caracteres.',
            'secret_key.regex' => 'La Secret Key debe contener solo caracteres hexadecimales.',

            'passphrase.min' => 'El Passphrase debe tener al menos 6 caracteres.',
        ]);

        // Sanitización adicional
        $validated['name'] = strip_tags(trim($validated['name']));
        $validated['api_key'] = trim($validated['api_key']);

        // Solo actualizar secret_key y passphrase si se proporcionan
        if (!empty($validated['secret_key'])) {
            $validated['secret_key'] = trim($validated['secret_key']);
        } else {
            unset($validated['secret_key']);
        }

        if (!empty($validated['passphrase'])) {
            $validated['passphrase'] = trim($validated['passphrase']);
        } else {
            unset($validated['passphrase']);
        }

        $validated['is_demo'] = $request->has('is_demo');

        $account->update($validated);

        return redirect()->route('bitget.accounts.index')
            ->with('success', 'Cuenta actualizada exitosamente');
    }

    public function destroy(BitgetAccount $account)
    {
        // Autorización: verificar que el usuario sea dueño de la cuenta
        if ($account->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para eliminar esta cuenta.');
        }

        $wasActive = $account->is_active;
        $accountName = e($account->name); // Escapar para evitar XSS en el mensaje
        $account->delete();

        // Si era la activa, activar otra
        if ($wasActive) {
            $firstAccount = Auth::user()->bitgetAccounts()->first();
            if ($firstAccount) {
                $firstAccount->update(['is_active' => true]);
            }
        }

        return redirect()->route('bitget.accounts.index')
            ->with('success', 'Cuenta eliminada exitosamente');
    }

    public function activate(BitgetAccount $account)
    {
        // Autorización: verificar que el usuario sea dueño de la cuenta
        if ($account->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para activar esta cuenta.');
        }

        $account->activate();
        $accountName = e($account->name); // Escapar para evitar XSS

        return redirect()->route('bitget.accounts.index')
            ->with('success', "Cuenta '{$accountName}' activada");
    }
}
