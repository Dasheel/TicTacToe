<?php

namespace Tests\Unit\Enums;

use Tests\TestCase;
use App\Enums\GameStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @internal
 */
class GameStatusTest extends TestCase
{
    use RefreshDatabase;

    public function testHasExpectedValues()
    {
        $this->assertEquals('in_progress', GameStatus::IN_PROGRESS->value);
        $this->assertEquals('completed', GameStatus::COMPLETED->value);
    }

    public function testIsInProgress()
    {
        $status = GameStatus::IN_PROGRESS;
        $this->assertTrue($status->isInProgress());
        $this->assertFalse($status->isCompleted());
    }

    public function testIsCompleted()
    {
        $status = GameStatus::COMPLETED;
        $this->assertTrue($status->isCompleted());
        $this->assertFalse($status->isInProgress());
    }
}
