<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
        'id' => $this->id,
        'title' => $this->title,
        'price' => $this->price,
        'detail' => $this->detail,
        'stock' => $this->stock,
        'state_appliance' => $this->state_appliance,
        'delivery_method' => $this->delivery_method,
        'brand' => $this->brand,
        'address' => $this->address,
        'phone' => $this->phone,
        'categorie_id' => $this->categorie_id,
        'user_id' => $this->user_id,
        'image' => $this->image,
        'featured' => $this->featured,
        'created_at' => $this->created_at,
        'updated_at' => $this->updated_at,
        ];
    }
}
