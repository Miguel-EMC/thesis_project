<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule as ValidationRule;

class ProfileController extends Controller
{
    // función para mostrar los datos de perfil del usuario
    public function show()
    {
        // Se obtiene el usuario autenticado
        $user = Auth::user();
        // Se invoca a la función padre
        return $this->sendResponse(message: "User's profile returned successfully", result: [
            'user' => new ProfileResource($user),
            'avatar' => $user->getAvatarPath(),
        ]);
    }

    // función para actualizar los datos del usuario
    public function store(Request $request)
    {
        // Validación de los datos de entrada
        $request->validate([
            'username' => ['required', 'string', 'min:5', 'max:20', ValidationRule::unique('users')->ignore($request->user()->id)],
            'first_name' => ['required', 'string', 'min:3', 'max:35'],
            'last_name' => ['required', 'string', 'min:3', 'max:35'],
            // https://laravel.com/docs/9.x/validation#rule-unique
            'personal_phone' => ['required', 'numeric', 'digits:10'],
            'home_phone' => ['nullable', 'numeric', 'digits:9'],
            'address' => ['required', 'string', 'min:5', 'max:50'],
        ]);

        // Se obtiene el modelo del usuario
        $user = $request->user();
        // Se actualiza el modelo en la BDD
        // https://laravel.com/docs/9.x/queries#update-statements
        $user->update($request->all());
        // Se invoca a la función padre
        return $this->sendResponse('Profile updated successfully');
    }
}