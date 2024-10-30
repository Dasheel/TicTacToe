<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Models\Game;
use App\Enums\GameStatus;
use App\Enums\GameWinner;
use Mockery\MockInterface;
use App\Services\Contracts\GameService;
use App\Exceptions\InvalidMoveException;
use App\Helpers\Contracts\GameResultHelper;
use App\Repositories\Contracts\GameRepository;
use App\Exceptions\GameAlreadyCompletedException;

/**
 * @internal
 */
class GameServiceTest extends TestCase
{
    public function testStartNewGame()
    {
        $game = Game::factory()->create();

        $attributes = [
            'grid' => json_encode(array_fill(0, 9, null)),
            'status' => GameStatus::IN_PROGRESS,
            'turn' => 'X',
        ];

        $this->mock(GameRepository::class, function (MockInterface $mock) use ($attributes, $game) {
            $mock->allows('createNewGame')->once()->with($attributes)->andReturn($game);
        });

        /** @var GameService $service */
        $service = $this->app->make(GameService::class);
        $service->startNewGame();
    }

    public function testMakeMoveUpdates(): void
    {
        $game = Game::factory()->create();
        $grid = json_decode($game->grid, true);
        $grid[0] = $game->turn->value;

        $this->mock(GameRepository::class, function (MockInterface $mock) use ($game, $grid) {
            $attributes = [
                'grid' => json_encode($grid),
                'turn' => $game->turn->next(),
            ];

            $gameUpdated = Game::factory()->create([
                'grid' => json_encode($grid),
                'turn' => $game->turn->next(),
            ]);
            $mock->allows('updateGame')->once()->with($game, $attributes)->andReturn($gameUpdated);
        });

        $this->mock(GameResultHelper::class, function (MockInterface $mock) use ($game, $grid) {
            $mock->allows('determineWinner')->once()->with($game, $grid)->andReturnNull();
        });

        /** @var GameService $service */
        $service = $this->app->make(GameService::class);
        $service->makeMove($game, 0);
    }

    public function testMakeMoveThrowsExceptionIfGameIsCompleted(): void
    {
        $this->expectException(GameAlreadyCompletedException::class);
        $this->expectExceptionMessage('Game is already completed');

        $game = Game::factory()->completedWithWinner(GameWinner::PLAYER_1)->create();

        /** @var GameService $service */
        $service = $this->app->make(GameService::class);
        $service->makeMove($game, 0);
    }

    public function testMakeMoveThrowsExceptionIfPositionAlreadyTaken()
    {
        $this->expectException(InvalidMoveException::class);
        $this->expectExceptionMessage('The move is invalid.');

        $game = Game::factory()->completedWithWinner(GameWinner::PLAYER_1)->create([
            'status' => GameStatus::IN_PROGRESS,
            'grid' => json_encode(['X', null, null, null, null, null, null, null, null]),
        ]);

        /** @var GameService $service */
        $service = $this->app->make(GameService::class);
        $service->makeMove($game, 0);
    }
}
