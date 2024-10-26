<?php

namespace App\Http\Resources\Game;

use App\Models\Game;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Game
 */
class Model extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'grid' => json_decode($this->grid),
            'turn' => $this->turn->value,
            'winner' => $this->winner,
            'created_at' => $this->created_at->toDateString(),
            'updated_at' => $this->updated_at->toDateString(),
        ];
    }
}
