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
        $game = Game::factory()->completedWithWinner(GameWinner::X->value)->create();

        /** @var GameResultHelper $helper */
        $helper = $this->app->make(GameResultHelper::class);
        $this->assertEquals(GameWinner::X->value, $helper->determineWinner($game, json_decode($game->grid, true))->value);
    }

    public function testIsDraw(): void
    {
        $game = Game::factory()->completedDraw()->create();

        /** @var GameResultHelper $helper */
        $helper = $this->app->make(GameResultHelper::class);
        $this->assertEquals(GameWinner::Draw, $helper->determineWinner($game, json_decode($game->grid, true)));
    }
}
