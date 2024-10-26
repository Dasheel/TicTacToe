<?php

namespace Tests\Feature\Game;

use Tests\TestCase;
use App\Models\Game;
use App\Enums\GameStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @internal
 */
class GameMoveTest extends TestCase
{
    use RefreshDatabase;

    public function testMakeMove(): void
    {
        $game = Game::factory()->create([
            'status' => GameStatus::IN_PROGRESS,
            'grid' => json_encode([null, null, null, null, null, null, null, null, null]),
            'turn' => 'X',
            'winner' => null,
        ]);

        $response = $this->postJson(route('games.move', $game->id), ['position' => 0]);
        $response->assertStatus(200)
            ->assertJsonStructure([
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

    public function testNotFound(): void
    {
        $response = $this->postJson(route('games.move', 1), ['position' => 0]);
        $response->assertNotFound();
    }

    /**
     * @dataProvider position
     *
     * @param string $input
     * @param mixed  $value
     */
    public function testInvalidMoveRequest(string $input, mixed $value): void
    {
        $game = Game::factory()->create([
            'status' => GameStatus::IN_PROGRESS,
            'grid' => json_encode([null, null, null, null, null, null, null, null, null]),
            'turn' => 'X',
            'winner' => null,
        ]);

        $response = $this->postJson(route('games.move', $game->id), [$input => $value]);
        $response->assertUnprocessable();
        $response->assertJsonValidationErrorFor($input);
    }

    public static function position()
    {
        return [
            ['position', 'foo'],
            ['position', null],
            ['position', ''],
            ['position', -1],
            ['position', 9],
            ['position', []],
            ['position', ['foo']],
        ];
    }
}
