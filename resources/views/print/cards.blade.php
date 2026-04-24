@extends('layouts.print')

@section('content')
<div style="text-align: center; margin-bottom: 20px;">
    <h1>{{ $game->getName() }} - Game Cards</h1>
    <p>Print these cards for your Monopoly game</p>
</div>

{{-- Chance Cards --}}
<div class="page-break">
    <h2 style="text-align: center; margin-bottom: 20px;">Chance Cards</h2>

    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; max-width: 800px; margin: 0 auto;">
        @foreach($game->getChanceCards() as $index => $card)
        <div style="border: 2px solid #000; padding: 15px; min-height: 120px; background: #fff;">
            <div style="font-size: 18px; font-weight: bold; margin-bottom: 10px; color: #d4af37;">CHANCE</div>
            <div style="font-size: 14px; line-height: 1.4;">{{ $card['text'] }}</div>
            <div style="font-size: 10px; margin-top: 10px; color: #666; border-top: 1px solid #ccc; padding-top: 5px;">
                Card {{ $index + 1 }} of {{ count($game->getChanceCards()) }}
            </div>
        </div>
        @endforeach
    </div>
</div>

{{-- Community Chest Cards --}}
<div class="page-break">
    <h2 style="text-align: center; margin-bottom: 20px;">Community Chest Cards</h2>

    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; max-width: 800px; margin: 0 auto;">
        @foreach($game->getCommunityChestCards() as $index => $card)
        <div style="border: 2px solid #000; padding: 15px; min-height: 120px; background: #fff;">
            <div style="font-size: 18px; font-weight: bold; margin-bottom: 10px; color: #4169e1;">COMMUNITY CHEST</div>
            <div style="font-size: 14px; line-height: 1.4;">{{ $card['text'] }}</div>
            <div style="font-size: 10px; margin-top: 10px; color: #666; border-top: 1px solid #ccc; padding-top: 5px;">
                Card {{ $index + 1 }} of {{ count($game->getCommunityChestCards()) }}
            </div>
        </div>
        @endforeach
    </div>
</div>

{{-- Property Cards --}}
<div class="page-break">
    <h2 style="text-align: center; margin-bottom: 20px;">Property Cards</h2>

    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; max-width: 800px; margin: 0 auto;">
        @foreach($game->getSquares() as $square)
            @if($square['groupNumber'] > 0 && $square['price'] > 0)
            <div style="border: 2px solid #000; padding: 15px; background: #fff;">
                <div style="background-color: {{ $square['color'] }}; color: white; padding: 8px; text-align: center; font-weight: bold; margin-bottom: 10px;">
                    {{ $square['name'] }}
                </div>
                <div style="font-size: 12px; line-height: 1.4;">
                    <strong>PRICE:</strong> ${{ $square['price'] }}<br>
                    <strong>RENT:</strong> ${{ $square['baserent'] }}<br>
                    @if($square['rent1'] > 0)
                    <strong>With 1 House:</strong> ${{ $square['rent1'] }}<br>
                    <strong>With 2 Houses:</strong> ${{ $square['rent2'] }}<br>
                    <strong>With 3 Houses:</strong> ${{ $square['rent3'] }}<br>
                    <strong>With 4 Houses:</strong> ${{ $square['rent4'] }}<br>
                    <strong>With Hotel:</strong> ${{ $square['rent5'] }}<br>
                    @endif
                    <strong>Mortgage Value:</strong> ${{ intval($square['price'] / 2) }}<br>
                    @if($square['houseprice'] > 0)
                    <strong>Houses cost:</strong> ${{ $square['houseprice'] }} each<br>
                    <strong>Hotels:</strong> ${{ $square['houseprice'] }} plus 4 houses<br>
                    @endif
                </div>
            </div>
            @endif
        @endforeach
    </div>
</div>

{{-- Rules Summary --}}
<div class="page-break">
    <h2 style="text-align: center; margin-bottom: 20px;">Game Rules Summary</h2>

    <div style="max-width: 600px; margin: 0 auto; text-align: left; line-height: 1.6;">
        <h3 style="color: #333; border-bottom: 2px solid #333; padding-bottom: 5px;">{{ $game->getName() }}</h3>

        <h4>Basic Rules:</h4>
        <ul>
            <li>Starting Money: ${{ $game->getRules()['startingMoney'] ?? 1500 }}</li>
            <li>Pass GO: Collect ${{ $game->getRules()['passGoAmount'] ?? 200 }}</li>
            <li>Jail Fine: ${{ $game->getRules()['jailFine'] ?? 50 }}</li>
            <li>Maximum Players: {{ $game->getRules()['maxPlayers'] ?? 8 }}</li>
        </ul>

        <h4>Property Rules:</h4>
        <ul>
            <li>Buy properties when you land on them</li>
            <li>Collect rent when other players land on your properties</li>
            <li>Build houses and hotels to increase rent (when you own all properties of a color group)</li>
            <li>Mortgage properties for cash (50% of purchase price)</li>
            <li>Unmortgage properties for 55% of purchase price</li>
        </ul>

        <h4>Special Spaces:</h4>
        <ul>
            <li><strong>GO:</strong> Collect $200 when passing</li>
            <li><strong>Jail:</strong> Pay $50 or use "Get Out of Jail Free" card</li>
            <li><strong>Free Parking:</strong> Just visiting or collect fines</li>
            <li><strong>Go to Jail:</strong> Move directly to jail</li>
            <li><strong>Chance/Community Chest:</strong> Draw and follow card instructions</li>
            <li><strong>Tax spaces:</strong> Pay the required amount</li>
        </ul>

        <h4>Winning:</h4>
        <ul>
            <li>Last player with money remaining wins</li>
            <li>All other players go bankrupt when they can't pay debts</li>
        </ul>
    </div>
</div>

<div style="text-align: center; margin-top: 30px; font-size: 12px; color: #666;">
    <p>{{ $game->getName() }} - Game Cards & Rules</p>
    <p>Generated on {{ now()->format('M j, Y') }}</p>
</div>
@endsection
