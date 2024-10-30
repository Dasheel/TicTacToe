<?php

namespace Database\Factories;

use App\Models\Game;
use App\Enums\GameStatus;
use App\Enums\GameWinner;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Game>
 */
class GameFactory extends Factory
{
    protected $model = Game::class;

    public function definition(): array
    {
        return [
            'status' => GameStatus::IN_PROGRESS,
            'grid' => json_encode(array_fill(0, 9, null)),
            'player_id' => 1,
            'winner' => null,
        ];
    }

    public function completedWithWinner(GameWinner $winner): static
    {
        return $this->state(function () use ($winner) {
            return [
                'status' => GameStatus::COMPLETED,
                'player_id' => $winner->value === 'Player 1' ? 1 : 2,
                'winner' => $winner,
                'grid' => json_encode([1, 1, 1, null, null, null, 2, 2, null]),
            ];
        });
    }

    public function completedDraw(): static
    {
        return $this->state(function () {
            return [
                'status' => GameStatus::COMPLETED,
                'player_id' => random_int(1, 2),
                'winner' => GameWinner::DRAW,
                'grid' => json_encode([1, 2, 1, 2, 2, 1, 1, 1, 2]),
            ];
        });
    }
}
