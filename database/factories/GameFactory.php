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
            'turn' => 1,
            'winner' => null,
        ];
    }

    public function completedWithWinner(GameWinner $winner): static
    {
        return $this->state(function () use ($winner) {
            return [
                'status' => GameStatus::COMPLETED,
                'winner' => $winner,
                'grid' => json_encode(['X', 'X', 'X', null, null, null, 'O', 'O', null]),
            ];
        });
    }

    public function completedDraw(): static
    {
        return $this->state(function () {
            return [
                'status' => GameStatus::COMPLETED,
                'winner' => GameWinner::DRAW,
                'grid' => json_encode(['X', 'O', 'X', 'O', 'O', 'X', 'X', 'X', 'O']),
            ];
        });
    }
}
