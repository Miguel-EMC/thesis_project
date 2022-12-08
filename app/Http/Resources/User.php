<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'personal_phone' => $this->personal_phone,
            'home_phone' => $this->home_phone,
            'address' => $this->address,
            'email' => $this->email,
            'categories' => $this->categories,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
