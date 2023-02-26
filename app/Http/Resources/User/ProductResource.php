<?php

namespace App\Http\Resources\User;

use App\Models\ProductVariation;
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
        return [
            'id' => $this->id,
            'title' => $this->title,
            'image' => $this->entity ?  env('APP_URL') . $this->entity->image?->path : env('APP_URL') . '/assets/no-image.png',
            'variations' => ProductVariationResource::collection($this->product_options)
        ];
    }
}
