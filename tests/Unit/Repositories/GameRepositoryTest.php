<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;
use App\Models\Game;
use App\Enums\GameStatus;
use App\Enums\GameWinner;
use App\Repositories\Contracts\GameRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @internal
 */
class GameRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateGameWithDefaultValues()
    {
        $attributes = [
            'grid' => json_encode(array_fill(0, 9, null)),
            'status' => GameStatus::IN_PROGRESS,
            'player_id' => 1,
        ];

        /** @var GameRepository $repository */
        $repository = $this->app->make(GameRepository::class);
        $game = $repository->createNewGame($attributes);

        $this->assertInstanceOf(Game::class, $game);

        $this->assertEquals('in_progress', $game->status->value);
        $this->assertEquals(json_encode([null, null, null, null, null, null, null, null, null]), $game->grid);
        $this->assertEquals(1, $game->player_id);
        $this->assertNull($game->winner);

        $this->assertDatabaseHas('games', [
            'id' => $game->id,
            'status' => 'in_progress',
            'grid' => json_encode([null, null, null, null, null, null, null, null, null]),
            'player_id' => 1,
            'winner' => null,
        ]);
    }

    public function testUpdateGame(): void
    {
        $game = Game::factory()->create([
            'status' => GameStatus::IN_PROGRESS,
            'grid' => json_encode([1, null, 1, 2, 2, null, null, null, null]),
            'player_id' => 1,
        ]);

        $data = [
            'status' => GameStatus::COMPLETED,
            'grid' => json_encode([1, 1, 1, 2, 2, null, null, null, null]),
            'player_id' => 2,
            'winner' => GameWinner::PLAYER_1,
        ];

        /** @var GameRepository $repository */
        $repository = $this->app->make(GameRepository::class);
        $updatedGame = $repository->updateGame($game, $data);

        $this->assertEquals('completed', $updatedGame->status->value);
        $this->assertEquals(json_encode([1, 1, 1, 2, 2, null, null, null, null]), $updatedGame->grid);
        $this->assertEquals(2, $updatedGame->player_id);
        $this->assertEquals('Player 1', $updatedGame->winner->value);

        $this->assertDatabaseHas('games', [
            'id' => $game->id,
            'status' => 'completed',
            'grid' => json_encode([1, 1, 1, 2, 2, null, null, null, null]),
            'player_id' => 2,
            'winner' => 'Player 1',
        ]);
    }
}
