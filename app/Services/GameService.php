<?php

namespace App\Services;

use App\Models\Game;
use App\Enums\GameStatus;
use App\Exceptions\InvalidMoveException;
use App\Exceptions\InvalidPlayerException;
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

    public function makeMove(Game $game, int $position, int $playerId): Game
    {
        if (!$game->status->isInProgress()) {
            throw new GameAlreadyCompletedException();
        }

        if ($game->player_id !== $playerId) {
            throw new InvalidPlayerException();
        }

        $grid = json_decode($game->grid, true);
        if ($grid[$position] !== null) {
            throw new InvalidMoveException();
        }

        $grid[$position] = $playerId;
        $attributes = [
            'grid' => json_encode($grid),
            'turn' => $game->nextPlayer(),
        ];

        $winner = $this->gameResultHelper->determineWinner($game, $grid);
        if ($winner !== null) {
            $attributes['status'] = GameStatus::COMPLETED;
            $attributes['winner'] = $winner;
        }

        return $this->gameRepository->updateGame($game, $attributes);
    }
}
