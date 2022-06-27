<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource {
    public function toArray($request): array {
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'type' => 'post',
            'attributes' => [
                'title' => $this->title,
                'body' => $this->body,
                'description' => $this->description,
                'published' => $this->published,
            ],
            'relationships' => [
                'author' => new UserResource($this->whenLoaded(relationship:'user')),
            ],
            'links' => [
                'self' => route('api:v1:posts:show',$this->uuid),
                'parent' => route('api:v1:posts:index')
            ]
        ];
    }
}
