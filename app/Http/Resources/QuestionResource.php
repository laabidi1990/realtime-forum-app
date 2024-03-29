<?php

namespace App\Http\Resources;

use App\Http\Resources\ReplyResource;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'path' => $this->path,
            'body' => $this->body,
            'creation_date' => $this->created_at->diffForHumans(),
            'writer' => $this->user->name,
            'user_id' => $this->user_id,
            'category_id' => $this->category_id,
            'replies' => ReplyResource::collection($this->replies),
            'replies_count' => $this->replies->count(),
        ];
    }
}
