<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReplyResource extends JsonResource
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
            'id' => $this->id,
            'reply' => $this->body,
            'replier' => $this->user->name,
            'replier_id' => $this->user->id,
            'reply_date' => $this->created_at->diffForHumans(),
            'question_slug' => $this->question->slug,
            'likes_count' => $this->likes->count(),
            'liked' => !! $this->likes->where('user_id', auth()->id())->count(), 
        ];
    }
}
