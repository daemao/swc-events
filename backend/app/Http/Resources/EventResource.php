<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'body'=>$this->body,
            'date'=>$this->date,
            'permissions'=>$this->userPermissions,
            'author'=>UserResouce::make($this->whenLoaded('author')),
            'author_name'=>$this->author_name,
            'users'=>UserResouce::collection($this->whenLoaded('users'))
        ];
    }
}
