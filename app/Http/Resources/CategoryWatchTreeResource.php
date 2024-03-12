<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryWatchTreeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'id' => $this->id,
            'label' => $this->name,
            // 'isSpecial' => $this->isSpecial,
            // 'price' => $this->price,
        ];

        if ($this->children ?? false) {
            $data['children'] = $this->children;
        }

        return $data;
    }
}
