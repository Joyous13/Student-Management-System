<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'class' => $this->class?->name,
            'parent_phone' => maskPhone($this->parent_phone),
            'photo_url' => $this->photo_path ? asset('storage/'.$this->photo_path) : null,
        ];
    }
}
