<?php

namespace Tests\Unit\Helpers;

use Tests\TestCase;
use App\Models\Game;
use App\Enums\GameWinner;
use Mockery\MockInterface;
use App\Managers\Contracts\WinnerManager;
use App\Helpers\Contracts\GameResultHelper;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @internal
 */
class GameResultHelperTest extends TestCase
{
    use RefreshDatabase;

    public function testDetermineWinnerWithWinner(): void
    {
        $game = Game::factory()->completedWithWinner(GameWinner::PLAYER_1)->create();
        $grid = json_decode($game->grid, true);

        $this->mock(WinnerManager::class, function (MockInterface $mock) use ($grid) {
            $mock->allows('hasWinner')->once()->with($grid)->andReturn(true);
        });

        /** @var GameResultHelper $helper */
        $helper = $this->app->make(GameResultHelper::class);
        $this->assertEquals(GameWinner::PLAYER_1->value, $helper->determineWinner($game, $grid)->value);
    }

    public function testDetermineWinnerWithDraw(): void
    {
        $game = Game::factory()->completedDraw()->create();
        $grid = json_decode($game->grid, true);

        $this->mock(WinnerManager::class, function (MockInterface $mock) use ($grid) {
            $mock->allows('hasWinner')->once()->with($grid)->andReturn(false);
            $mock->allows('isDraw')->once()->with($grid)->andReturn(true);
        });

        /** @var GameResultHelper $helper */
        $helper = $this->app->make(GameResultHelper::class);
        $this->assertEquals(GameWinner::DRAW, $helper->determineWinner($game, $grid));
    }

    public function testDetermineWinnerAndReturnNull(): void
    {
        $game = Game::factory()->completedDraw()->create();
        $grid = json_decode($game->grid, true);

        $this->mock(WinnerManager::class, function (MockInterface $mock) use ($grid) {
            $mock->allows('hasWinner')->once()->with($grid)->andReturn(false);
            $mock->allows('isDraw')->once()->with($grid)->andReturn(false);
        });

        /** @var GameResultHelper $helper */
        $helper = $this->app->make(GameResultHelper::class);
        $this->assertNull($helper->determineWinner($game, $grid));
    }
}
