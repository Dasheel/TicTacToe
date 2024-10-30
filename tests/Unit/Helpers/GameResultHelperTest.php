<?php

namespace Tests\Unit\Helpers;

use Tests\TestCase;
use App\Models\Game;
use App\Enums\GameWinner;
use App\Helpers\Contracts\GameResultHelper;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @internal
 */
class GameResultHelperTest extends TestCase
{
    use RefreshDatabase;

    public function testDetermineWinner(): void
    {
        $game = Game::factory()->completedWithWinner(GameWinner::PLAYER_1)->create();

        /** @var GameResultHelper $helper */
        $helper = $this->app->make(GameResultHelper::class);
        $this->assertEquals(GameWinner::PLAYER_1->value, $helper->determineWinner($game, json_decode($game->grid, true))->value);
    }

    public function testIsDraw(): void
    {
        $game = Game::factory()->completedDraw()->create();

        /** @var GameResultHelper $helper */
        $helper = $this->app->make(GameResultHelper::class);
        $this->assertEquals(GameWinner::DRAW, $helper->determineWinner($game, json_decode($game->grid, true)));
    }
}
