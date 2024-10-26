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
            'turn' => 'X',
            'winner' => null,
        ]);

        $resource = new GameResource($game);

        $resourceArray = $resource->toArray(request());

        $this->assertEquals([
            'id' => $game->id,
            'status' => GameStatus::IN_PROGRESS,
            'grid' => [null, null, null, null, null, null, null, null, null],
            'turn' => 'X',
            'winner' => null,
            'created_at' => $game->created_at->toDateString(),
            'updated_at' => $game->updated_at->toDateString(),
        ], $resourceArray);
    }
}
