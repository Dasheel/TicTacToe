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
        $this->assertTrue($manager->hasWinner([1, 1, 1, null, null, null, null, null, null]));
    }

    public function testNotWinningCondition(): void
    {
        /** @var WinnerManager $manager */
        $manager = $this->app->make(WinnerManager::class);
        $this->assertFalse($manager->hasWinner([1, 2, 1, 2, 2, 1, 1, 1, 2]));
    }

    public function testDrawCondition(): void
    {
        /** @var WinnerManager $manager */
        $manager = $this->app->make(WinnerManager::class);
        $this->assertTrue($manager->isDraw([1, 2, 1, 2, 1, 2, 2, 1, 2]));
    }

    public function testNotDrawCondition(): void
    {
        /** @var WinnerManager $manager */
        $manager = $this->app->make(WinnerManager::class);
        $this->assertFalse($manager->isDraw([1, 2, null, 2, 1, 2, 2, 1, null]));
    }
}
