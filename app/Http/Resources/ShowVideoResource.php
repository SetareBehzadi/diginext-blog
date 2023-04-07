<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowVideoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "title" => $this->title,
            "url" => $this->url,
            "comments" => $this->whenLoaded('comments', CommentResource::collection($this->comments), null),
            "username" => $this->user->username,
        ];
    }
}
