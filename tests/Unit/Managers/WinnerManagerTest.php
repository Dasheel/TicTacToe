<?php

namespace Tests\Unit\Managers;

use Tests\TestCase;
use App\Managers\Contracts\WinnerManager;

/**
 * @internal
 */
class WinnerManagerTest extends TestCase
{
    public function testWinningCondition(): void
    {
        /** @var WinnerManager $manager */
        $manager = $this->app->make(WinnerManager::class);
        $this->assertTrue($manager->hasWinner(['X', 'X', 'X', null, null, null, null, null, null]));
    }

    public function testNotWinningCondition(): void
    {
        /** @var WinnerManager $manager */
        $manager = $this->app->make(WinnerManager::class);
        $this->assertFalse($manager->hasWinner(['X', 'O', 'X', 'O', 'O', 'X', 'X', 'X', 'O']));
    }
}
