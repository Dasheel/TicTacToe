<?php

namespace Tests\Unit\Enums;

use Tests\TestCase;
use App\Models\Game;
use App\Enums\GameWinner;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @internal
 */
class GameWinnerTest extends TestCase
{
    use RefreshDatabase;

    public function testHasExpectedValues()
    {
        $this->assertEquals('Player 1', GameWinner::PLAYER_1->value);
        $this->assertEquals('Player 2', GameWinner::PLAYER_2->value);
        $this->assertEquals('Draw', GameWinner::DRAW->value);
    }

    public function testFromTurn()
    {
        $game = Game::factory()->completedWithWinner(GameWinner::PLAYER_1)->create();
        $this->assertEquals(GameWinner::PLAYER_1, GameWinner::fromGame($game));

        $game2 = Game::factory()->completedWithWinner(GameWinner::PLAYER_2)->create();
        $this->assertEquals(GameWinner::PLAYER_2, GameWinner::fromGame($game2));
    }
}
