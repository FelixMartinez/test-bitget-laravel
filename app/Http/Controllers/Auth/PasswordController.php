<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => [
                'required',
                'min:8',
                'regex:/[a-z]/',      // Al menos una minúscula
                'regex:/[A-Z]/',      // Al menos una mayúscula
                'regex:/[0-9]/',      // Al menos un número
                'confirmed'
            ],
        ], [
            'current_password.required' => 'Debes ingresar tu contraseña actual.',
            'current_password.current_password' => 'La contraseña actual es incorrecta.',

            'password.required' => 'La nueva contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.regex' => 'La contraseña debe contener al menos una mayúscula, una minúscula y un número.',
            'password.confirmed' => 'Las contraseñas no coinciden. Por favor, verifícalas.',
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
    }
}
