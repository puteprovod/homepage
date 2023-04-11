<?php

namespace App\Http\Resources\Currency;

use Illuminate\Http\Resources\Json\JsonResource;

class CurrencyResource extends JsonResource
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
            'long_title' => $this->long_title,
         //   'date' => $this->updated_at->diffForHumans(),
            'date' => date ('d/m H:i',strtotime($this->updated_at)),
            'exchange_rate' => round($this->exchange_rate,2),
            'source' => $this->source,
            'priority' => $this->priority,

        ];
    }
}
