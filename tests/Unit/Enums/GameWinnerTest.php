<?php

namespace Tests\Unit\Enums;

use Tests\TestCase;
use App\Enums\GameTurn;
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
        $this->assertEquals('X', GameWinner::X->value);
        $this->assertEquals('O', GameWinner::O->value);
        $this->assertEquals('draw', GameWinner::Draw->value);
    }

    public function testFromTurn()
    {
        $this->assertEquals(GameWinner::X, GameWinner::fromTurn(GameTurn::X));
        $this->assertEquals(GameWinner::O, GameWinner::fromTurn(GameTurn::O));
    }
}
