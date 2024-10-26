<?php

namespace Tests\Unit\Enums;

use Tests\TestCase;
use App\Enums\GameTurn;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @internal
 */
class GameTurnTest extends TestCase
{
    use RefreshDatabase;

    public function testExpectedValues(): void
    {
        $this->assertEquals('X', GameTurn::X->value);
        $this->assertEquals('O', GameTurn::O->value);
    }
}
