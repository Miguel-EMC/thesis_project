<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'price_min' => $this->price_min,
            'price_max' => $this->price_max,
            'detail' => $this->detail,
            'stock' => $this->stock,
            'state_appliance' => $this->state_appliance,
            'state' => $this->state,
            'delivery_method' => $this->delivery_method,
            'brand' => $this->brand,
            'user_id' => $this->user_id,
            'category_id' => $this->category_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
