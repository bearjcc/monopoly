@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-600 to-purple-700 flex items-center justify-center p-4">
    <div class="max-w-4xl w-full">
        <div class="text-center mb-8">
            <h1 class="text-6xl font-bold text-white mb-4 drop-shadow-lg">
                🎲 Monopoly
            </h1>
            <p class="text-xl text-blue-100 mb-8">
                Choose your game edition below to start playing!
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($games as $gameId => $gameInfo)
            <div class="bg-white rounded-xl shadow-2xl overflow-hidden hover:shadow-3xl transition-all duration-300 transform hover:-translate-y-2">
                <div class="bg-gradient-to-r from-green-400 to-blue-500 p-6">
                    <div class="text-center">
                        <div class="text-4xl mb-2">🎮</div>
                        <h3 class="text-xl font-bold text-white">{{ $gameInfo['name'] }}</h3>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-gray-600 mb-4">
                        Play the classic {{ $gameInfo['name'] }} edition with all the traditional rules and properties.
                    </p>
                    <div class="flex gap-3">
                        <a href="{{ route('game.show', $gameId) }}"
                           class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg transition-colors duration-200 text-center">
                            🎲 Play Game
                        </a>
                        <a href="{{ route('print.board', $gameId) }}"
                           class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-3 px-4 rounded-lg transition-colors duration-200 text-center"
                           target="_blank">
                            🖨️ Print Board
                        </a>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('print.cards', $gameId) }}"
                           class="w-full bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg transition-colors duration-200 text-center inline-block"
                           target="_blank">
                            🃏 Print Cards
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @if(count($games) === 0)
        <div class="text-center">
            <div class="bg-white rounded-xl shadow-2xl p-8">
                <div class="text-6xl mb-4">🤔</div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4">No Games Found</h3>
                <p class="text-gray-600">
                    No game editions are currently available. Please check back later!
                </p>
            </div>
        </div>
        @endif

        <div class="text-center mt-12">
            <p class="text-blue-200 text-sm">
                Built with Laravel & PHP • Original Monopoly game mechanics preserved
            </p>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.hover\:shadow-3xl:hover {
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
}
</style>
@endpush
