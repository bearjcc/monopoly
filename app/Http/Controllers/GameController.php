<?php

namespace App\Http\Controllers;

use App\Models\GameData;

class GameController extends Controller
{
    /**
     * Display the game interface for a specific game
     */
    public function show($gameId)
    {
        try {
            $gameData = new GameData($gameId);

            return view('game', [
                'game' => $gameData,
                'gameId' => $gameId,
            ]);
        } catch (\Exception $e) {
            abort(404, "Game '{$gameId}' not found");
        }
    }
}
