<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Http\Requests\MoveRequest;
use App\Services\Contracts\GameService;
use App\Http\Resources\Game\Model as GameResource;

class GameController extends Controller
{
    public function __construct(private readonly GameService $gameService) {}

    public function startGame(): GameResource
    {
        $game = $this->gameService->startNewGame();

        return new GameResource($game);
    }

    public function makeMove(MoveRequest $request, Game $game): GameResource
    {
        $position = $request->validated('position');
        $playerId = $request->validated('player_id');
        $game = $this->gameService->makeMove($game, $position, $playerId);

        return new GameResource($game);
    }
}
