<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Notifications\RegisteredCostumerNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class CustomerController extends Controller
{
    // Crear un nuevo usuario cliente
    public function register(Request $request)
    {
        // Validación de los datos de entrada
        $request->validate([
            'username' => ['required', 'string', 'min:5', 'max:20'],
            'first_name' => ['required', 'string', 'min:3', 'max:35'],
            'last_name' => ['required', 'string', 'min:3', 'max:35'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'home_phone' => ['nullable', 'numeric', 'digits:7'],
            'personal_phone' => ['required', 'numeric', 'digits:10'],
            'address' => ['required', 'string', 'min:5', 'max:50'],
        ]);

        // Validación de los datos de entrada
        $validated = $request->validate([
            'password' => [
                'required',
                'string',
                'confirmed',
                Password::defaults()->mixedCase()->numbers()->symbols()
            ]
        ]);

        // Obtiene el rol del usuario cliente
        $role = Role::where('slug', 'customer')->first();

        // Crear una instancia del usuario cliente
        $user = new User($request->all());

        // Se setea el paasword al usuario
        $user->password = Hash::make($validated['password']);

        // Se almacena el usuario en la BD
        $role->users()->save($user);

        // Se procede a invocar la función para en envío de una notificación de registro
        $this->sendNotifications($user);

        // Invoca el controlador padre para la respuesta json
        return $this->sendResponse(
        message: 'User created successfully',
        result: $user,
        code: 201
        );
    }

    // Función para enviar notificaciones para el usuario registrado
    private function sendNotifications(User $user)
    {
            $user->notify(
            new RegisteredCostumerNotification(
                user_name: $user->getFullName(),
                role_name: $user->role->name
            )
        );
    }

}
