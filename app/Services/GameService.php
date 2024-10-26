<?php

namespace App\Services;

use App\Models\Game;
use App\Enums\GameStatus;
use App\Exceptions\InvalidMoveException;
use App\Helpers\Contracts\GameResultHelper;
use App\Repositories\Contracts\GameRepository;
use App\Exceptions\GameAlreadyCompletedException;
use App\Services\Contracts\GameService as GameServiceContract;

class GameService implements GameServiceContract
{
    public function __construct(
        private readonly GameRepository $gameRepository,
        private readonly GameResultHelper $gameResultHelper,
    ) {}

    public function startNewGame(): Game
    {
        $attributes = [
            'grid' => json_encode(array_fill(0, 9, null)),
            'status' => GameStatus::IN_PROGRESS,
            'turn' => 'X',
        ];

        return $this->gameRepository->createNewGame($attributes);
    }

    public function makeMove(Game $game, int $position): Game
    {
        if (!$game->status->isInProgress()) {
            throw new GameAlreadyCompletedException();
        }

        $grid = json_decode($game->grid, true);
        if ($grid[$position] !== null) {
            throw new InvalidMoveException();
        }

        $grid[$position] = $game->turn->value;
        $attributes = [
            'grid' => json_encode($grid),
            'turn' => $game->turn->next(),
        ];

        $winner = $this->gameResultHelper->determineWinner($game, $grid);
        if ($winner !== null) {
            $attributes['status'] = GameStatus::COMPLETED;
            $attributes['winner'] = $winner;
        }

        return $this->gameRepository->updateGame($game, $attributes);
    }
}