<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleCategoryResource extends JsonResource
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
            'article_id' => $this->article_id,
            'category_id' => $this->category_id,
            'is_primary' => $this->is_primary,
            'number' => $this->number,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
