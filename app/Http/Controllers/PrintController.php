<?php

namespace App\Http\Controllers;

use App\Models\GameData;

class PrintController extends Controller
{
    /**
     * Display the printable board for a specific game
     */
    public function board($gameId)
    {
        try {
            $gameData = new GameData($gameId);

            return view('print.board', [
                'game' => $gameData,
                'gameId' => $gameId,
            ]);
        } catch (\Exception $e) {
            abort(404, "Game '{$gameId}' not found");
        }
    }

    /**
     * Display the printable cards for a specific game
     */
    public function cards($gameId)
    {
        try {
            $gameData = new GameData($gameId);

            return view('print.cards', [
                'game' => $gameData,
                'gameId' => $gameId,
            ]);
        } catch (\Exception $e) {
            abort(404, "Game '{$gameId}' not found");
        }
    }
}
