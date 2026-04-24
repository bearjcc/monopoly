<?php

namespace App\Models;

use Illuminate\Support\Facades\File;

class GameData
{
    protected $gameId;

    protected $data;

    public function __construct($gameId)
    {
        $this->gameId = $gameId;
        $this->loadGameData();
    }

    /**
     * Load game data from JSON file
     */
    protected function loadGameData()
    {
        $filePath = resource_path("data/games/{$this->gameId}/game.json");

        if (! File::exists($filePath)) {
            throw new \Exception("Game data file not found: {$filePath}");
        }

        $jsonContent = File::get($filePath);
        $this->data = json_decode($jsonContent, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception('Invalid JSON in game data file: '.json_last_error_msg());
        }
    }

    /**
     * Get all game data
     */
    public function getAllData()
    {
        return $this->data;
    }

    /**
     * Get game name
     */
    public function getName()
    {
        return $this->data['name'] ?? 'Unknown Game';
    }

    /**
     * Get squares data
     */
    public function getSquares()
    {
        return $this->data['squares'] ?? [];
    }

    /**
     * Get chance cards data
     */
    public function getChanceCards()
    {
        return $this->data['chanceCards'] ?? [];
    }

    /**
     * Get community chest cards data
     */
    public function getCommunityChestCards()
    {
        return $this->data['communityChestCards'] ?? [];
    }

    /**
     * Get game rules
     */
    public function getRules()
    {
        return $this->data['rules'] ?? [];
    }

    /**
     * Get a specific square by index
     */
    public function getSquare($index)
    {
        $squares = $this->getSquares();

        return $squares[$index] ?? null;
    }

    /**
     * Get all available games
     */
    public static function getAvailableGames()
    {
        $gamesPath = resource_path('data/games');
        $games = [];

        if (File::exists($gamesPath)) {
            $directories = File::directories($gamesPath);

            foreach ($directories as $dir) {
                $gameId = basename($dir);
                $gameFile = $dir.'/game.json';

                if (File::exists($gameFile)) {
                    try {
                        $gameData = new self($gameId);
                        $games[$gameId] = [
                            'id' => $gameId,
                            'name' => $gameData->getName(),
                            'path' => $dir,
                        ];
                    } catch (\Exception $e) {
                        // Skip invalid game directories
                        continue;
                    }
                }
            }
        }

        return $games;
    }
}
