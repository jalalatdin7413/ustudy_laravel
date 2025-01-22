<?php 

namespace  App\Http\Resources\Core\V1\Posts;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class ShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'content' => $this->content,
            'view' => $this->view,
            'shared' => $this->shared,
            'recommended' => $this->recommended,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    } 
}