<?php

namespace CapstoneLogic\Pages\Resource;

use Illuminate\Http\Resources\Json\JsonResource;

class PageResource extends JsonResource {

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {
        return [
            'id' => $this->id,
            'user' => $this->user,
            'status_id' => $this->status_id,
            'status' => new StatusResource($this->status),
            'title' => $this->title,
            'content' => $this->content,
            'seo_title' => $this->seo_title,
            'seo_description' => $this->seo_description,
            'seo_keywords' => $this->seo_keywords,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}