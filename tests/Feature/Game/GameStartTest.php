<?php

namespace Tests\Feature\Game;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @internal
 */
class GameStartTest extends TestCase
{
    use RefreshDatabase;

    public function testStart(): void
    {
        $response = $this->postJson(route('games.start'));

        $response->assertCreated();
        $response->assertJsonStructure([
            'data' => [
                'id',
                'status',
                'grid',
                'turn',
                'winner',
                'created_at',
                'updated_at',
            ],
        ]);
    }
}
