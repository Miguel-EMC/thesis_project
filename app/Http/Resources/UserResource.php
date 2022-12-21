<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // Se procede a definir la estructura de la respuesta de la petición
        return [
            'username' => $this->username,
            'full_name' => $this->getFullName(),
            'email' => $this->email,
            'role' => $this->role->name,
            'home_phone' => $this->home_phone,
            'personal_phone' => $this->personal_phone,
            'address' => $this->address,
        ];
    }
}
