<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class AlbumResource extends JsonResource
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
            // Note: The Resource collection() method wraps your response in a 'data' array key. Data Wrapping: https://laravel.com/docs/9.x/eloquent-resources#data-wrapping
            'id'         => $this->id,
            'name'       => $this->name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}