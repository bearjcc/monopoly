<?php

namespace App\Http\Controllers;

use App\Models\GameData;

class SplashController extends Controller
{
    /**
     * Display the game selection splash screen
     */
    public function index()
    {
        $games = GameData::getAvailableGames();

        return view('splash', [
            'games' => $games,
        ]);
    }
}
