<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;
use App\Models\Game;
use App\Enums\GameStatus;
use App\Repositories\Contracts\GameRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @internal
 */
class GameRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateGameCreatesNewGameWithDefaultValues()
    {
        $attributes = [
            'grid' => json_encode(array_fill(0, 9, null)),
            'status' => GameStatus::IN_PROGRESS,
            'turn' => 'X',
        ];

        /** @var GameRepository $repository */
        $repository = $this->app->make(GameRepository::class);
        $game = $repository->createNewGame($attributes);

        $this->assertInstanceOf(Game::class, $game);

        $this->assertEquals('in_progress', $game->status->value);
        $this->assertEquals(json_encode([null, null, null, null, null, null, null, null, null]), $game->grid);
        $this->assertEquals('X', $game->turn->value);
        $this->assertNull($game->winner);

        $this->assertDatabaseHas('games', [
            'id' => $game->id,
            'status' => GameStatus::IN_PROGRESS,
            'grid' => json_encode([null, null, null, null, null, null, null, null, null]),
            'turn' => 'X',
            'winner' => null,
        ]);
    }

    public function testUpdateGameUpdatesFieldsCorrectly(): void
    {
        $game = Game::factory()->create([
            'status' => GameStatus::IN_PROGRESS,
            'grid' => json_encode([null, null, null, null, null, null, null, null, null]),
            'turn' => 'X',
        ]);

        $data = [
            'status' => GameStatus::COMPLETED,
            'grid' => json_encode(['X', 'X', 'X', null, null, null, null, null, null]),
            'turn' => 'O',
            'winner' => 'X',
        ];

        /** @var GameRepository $repository */
        $repository = $this->app->make(GameRepository::class);
        $updatedGame = $repository->updateGame($game, $data);

        $this->assertEquals('completed', $updatedGame->status->value);
        $this->assertEquals(json_encode(['X', 'X', 'X', null, null, null, null, null, null]), $updatedGame->grid);
        $this->assertEquals('O', $updatedGame->turn->value);
        $this->assertEquals('X', $updatedGame->winner->value);
    }
}
