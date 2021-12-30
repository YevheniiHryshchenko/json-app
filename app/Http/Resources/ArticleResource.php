<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
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
            'slug' => $this->slug,
            'content' => ContentResource::collection($this->content),
            'categories' => CategoryResource::collection($this->categories),
            'media' => MediaResource::collection($this->media),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
