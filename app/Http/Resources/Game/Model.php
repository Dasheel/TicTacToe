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
            'status' => $this->status->value,
            'grid' => json_decode($this->grid),
            'player_id' => $this->player_id,
            'winner' => $this->winner?->value,
            'created_at' => $this->created_at->toDateString(),
            'updated_at' => $this->updated_at->toDateString(),
        ];
    }
}
