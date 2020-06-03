<?php

namespace App\Http\Resources;

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
            'question' => $this->title,
            'path' => $this->path,
            'description' => $this->body,
            'creation-date' => $this->created_at->diffForHumans(),
            'question-writer' => $this->user->name,
        ];
    }
}
