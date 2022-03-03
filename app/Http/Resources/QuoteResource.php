<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class QuoteResource extends JsonResource
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
            'uuid' => $this->uuid,
            'quote' => $this->quote,
            'slug' => $this->slug,
            'author' => $this->author,
            'category' => $this->category->title,
            'date' => Carbon::parse($this->created_at)->format('d-m-Y'),
        ];
    }
}
