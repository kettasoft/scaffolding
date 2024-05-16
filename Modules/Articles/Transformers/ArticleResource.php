<?php

namespace Modules\Articles\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'content' => $this->content,
            'published_at' => $this->created_at->format('Y/m/d H:i A'),
            'image' => [
                'thumb' => $this->getFirstMediaUrl('default', 'thumb'),
                'small' => $this->getFirstMediaUrl('default', 'small'),
                'medium' => $this->getFirstMediaUrl('default', 'medium'),
                'large' => $this->getFirstMediaUrl('default', 'large'),
                'extra_large' => $this->getFirstMediaUrl('default', 'extra_large'),
                'original' => $this->getFirstMediaUrl('default'),
            ],
        ];
    }
}
