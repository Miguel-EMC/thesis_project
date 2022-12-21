<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
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
            'description' => $this->description,
            'product_id' => $this->product_id,
            'user_id' => $this->user_id,
            'user name' => $this->user->username,
        ];
    }
}
