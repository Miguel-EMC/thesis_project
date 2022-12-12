<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
     // Función padre que va a tomar las respuestas enviadas por los controladores hijos
     public function sendResponse(string $message, mixed $result = [], mixed $errors = [], int $code = 200)
     {
         $response = ['message' => $message];
         // Si el resultado no esta vacio se agrega otra clave y valor al array
         if (!empty($result))
         {
             $response['data'] = $result;
         }
         // Si los errores no estan vacios se agrega otra clave y valor al array
         if (!empty($errors))
         {
             $response['errors'] = $errors;
         }
         // Se determina el retorno de la respuesta
         return response()->json($response, $code);
     }
}