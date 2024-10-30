<?php

namespace Tests\Unit\Resources;

use Tests\TestCase;
use App\Models\Game;
use App\Enums\GameStatus;
use App\Http\Resources\Game\Model as GameResource;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @internal
 */
class GameResourceTest extends TestCase
{
    use RefreshDatabase;

    public function testGameResourceStructure()
    {
        $game = Game::factory()->create([
            'status' => GameStatus::IN_PROGRESS,
            'grid' => json_encode([null, null, null, null, null, null, null, null, null]),
            'player_id' => 1,
        ]);

        $resource = new GameResource($game);

        $resourceArray = $resource->toArray(request());

        $this->assertEquals([
            'id' => $game->id,
            'status' => 'in_progress',
            'grid' => [null, null, null, null, null, null, null, null, null],
            'player_id' => 1,
            'winner' => null,
            'created_at' => $game->created_at->toDateString(),
            'updated_at' => $game->updated_at->toDateString(),
        ], $resourceArray);
    }
}
