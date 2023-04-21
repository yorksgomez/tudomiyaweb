<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
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
            'location' => $this->location,
            'information' => $this->information,
            'state' => $this->state,
            'service_type' => $this->service_type,
            'domi' => new DomiResource($this->domi),
            'customer' => new CustomerResource($this->customer)
        ];
    }
}
