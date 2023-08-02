<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class ImageManipulationResource extends JsonResource
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
            'type'       => $this->type,
            'original'   => \Illuminate\Support\Facades\URL::to($this->path),        // the original image path URL/link (to be clickable for user)
            'output'     => \Illuminate\Support\Facades\URL::to($this->output_path), // the resized image path URL/link (to be clickable for user)
            'album_id'   => $this->album_id,
            'created_at' => $this->created_at
        ];
    }
}
