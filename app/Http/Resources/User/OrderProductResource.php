<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderProductResource extends JsonResource
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
            'quantity' => $this->pivot->quantity,
            'variant' =>$this->pivot->variant,   
            'image' => $this->entity ?  env('APP_URL') . $this->entity->image?->path : env('APP_URL') . '/assets/no-image.png',
    
        ];
    }
}
