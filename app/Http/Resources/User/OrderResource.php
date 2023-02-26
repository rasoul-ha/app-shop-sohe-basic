<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'status' => $this->status,
            'sku' => $this->sku,
            'shipping_cost' => $this->shipping_cost,
            'products_price' => $this->products_price,
            'total_price' => $this->total_price,
            'tax_percent' => $this->tax_percent,
            'taxt_price' => $this->tax_price,
            'delivery_person_name' => $this->delivery_person_name,
            'delivery_person_phone_number' => $this->delivery_person_phone_number,
            'step_delivery' => $this->step_delivery,
            'additional_note' => $this->additional_note,
            'created_at' => $this->created_at,
            'address' =>  new AddressResource($this->address),
            'products' => OrderProductResource::collection($this->products),
        ];
    }
}
