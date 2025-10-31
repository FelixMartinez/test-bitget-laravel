<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => [
                'required',
                'confirmed',
                'min:8',
                'regex:/[a-z]/',      // Al menos una minúscula
                'regex:/[A-Z]/',      // Al menos una mayúscula
                'regex:/[0-9]/',      // Al menos un número
            ],
        ], [
            // Mensajes personalizados en español
            'name.required' => 'El nombre completo es obligatorio.',
            'name.min' => 'El nombre debe tener al menos 3 caracteres.',
            'name.max' => 'El nombre no puede exceder los 255 caracteres.',
            'name.regex' => 'El nombre solo puede contener letras y espacios.',

            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Debes ingresar un correo electrónico válido.',
            'email.unique' => 'Este correo electrónico ya está registrado. ¿Quieres iniciar sesión?',
            'email.max' => 'El correo electrónico no puede exceder los 255 caracteres.',

            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden. Por favor, verifícalas.',
            'password.regex' => 'La contraseña debe contener al menos una mayúscula, una minúscula y un número.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
