@extends('layouts.print')

@section('content')
<div style="text-align: center; margin-bottom: 20px;">
    <h1>{{ $game->getName() }} - Game Board</h1>
    <p>Print this board for your Monopoly game</p>
</div>

{{-- Use the same board component but with print-friendly styling --}}
<div style="max-width: 800px; margin: 0 auto;">
    <table id="board" style="border: 2px solid black; border-spacing: 3px; margin: 25px auto;">
        <tr>
            <td class="cell board-corner" id="cell20">
                <div class="cell-name">{{ $game->getSquare(20)['name'] }}</div>
            </td>
            <td class="cell board-top" id="cell21">
                <div class="cell-name">{{ $game->getSquare(21)['name'] }}</div>
            </td>
            <td class="cell board-top" id="cell22">
                <div class="cell-name">{{ $game->getSquare(22)['name'] }}</div>
            </td>
            <td class="cell board-top" id="cell23">
                <div class="cell-name">{{ $game->getSquare(23)['name'] }}</div>
            </td>
            <td class="cell board-top" id="cell24">
                <div class="cell-name">{{ $game->getSquare(24)['name'] }}</div>
            </td>
            <td class="cell board-top" id="cell25">
                <div class="cell-name">{{ $game->getSquare(25)['name'] }}</div>
            </td>
            <td class="cell board-top" id="cell26">
                <div class="cell-name">{{ $game->getSquare(26)['name'] }}</div>
            </td>
            <td class="cell board-top" id="cell27">
                <div class="cell-name">{{ $game->getSquare(27)['name'] }}</div>
            </td>
            <td class="cell board-top" id="cell28">
                <div class="cell-name">{{ $game->getSquare(28)['name'] }}</div>
            </td>
            <td class="cell board-top" id="cell29">
                <div class="cell-name">{{ $game->getSquare(29)['name'] }}</div>
            </td>
            <td class="cell board-corner" id="cell30">
                <div class="cell-name">{{ $game->getSquare(30)['name'] }}</div>
            </td>
        </tr>
        <tr>
            <td class="cell board-left" id="cell19">
                <div class="cell-name">{{ $game->getSquare(19)['name'] }}</div>
            </td>
            <td colspan="9" class="board-center" style="text-align: center; vertical-align: middle; height: 200px;">
                <div style="font-size: 24px; font-weight: bold;">MONOPOLY</div>
                <div style="font-size: 18px; margin-top: 10px;">{{ $game->getName() }}</div>
                <div style="font-size: 14px; margin-top: 20px;">Place your pieces here when in jail</div>
            </td>
            <td class="cell board-right" id="cell31">
                <div class="cell-name">{{ $game->getSquare(31)['name'] }}</div>
            </td>
        </tr>
        <tr>
            <td class="cell board-left" id="cell18">
                <div class="cell-name">{{ $game->getSquare(18)['name'] }}</div>
            </td>
            <td colspan="9" class="board-center" style="text-align: center; vertical-align: middle;">
                <div style="font-size: 16px;">Game Area</div>
                <div style="font-size: 12px; margin-top: 5px;">Roll dice and move your tokens around the board</div>
            </td>
            <td class="cell board-right" id="cell32">
                <div class="cell-name">{{ $game->getSquare(32)['name'] }}</div>
            </td>
        </tr>
        <tr>
            <td class="cell board-left" id="cell17">
                <div class="cell-name">{{ $game->getSquare(17)['name'] }}</div>
            </td>
            <td colspan="9" class="board-center" style="text-align: center; vertical-align: middle;">
                <div style="font-size: 16px;">Property Cards</div>
                <div style="font-size: 12px; margin-top: 5px;">Place bought property cards face up here</div>
            </td>
            <td class="cell board-right" id="cell33">
                <div class="cell-name">{{ $game->getSquare(33)['name'] }}</div>
            </td>
        </tr>
        <tr>
            <td class="cell board-left" id="cell16">
                <div class="cell-name">{{ $game->getSquare(16)['name'] }}</div>
            </td>
            <td colspan="9" class="board-center" style="text-align: center; vertical-align: middle;">
                <div style="font-size: 16px;">Money & Tokens</div>
                <div style="font-size: 12px; margin-top: 5px;">Keep track of your money and place tokens here when not in use</div>
            </td>
            <td class="cell board-right" id="cell34">
                <div class="cell-name">{{ $game->getSquare(34)['name'] }}</div>
            </td>
        </tr>
        <tr>
            <td class="cell board-left" id="cell15">
                <div class="cell-name">{{ $game->getSquare(15)['name'] }}</div>
            </td>
            <td colspan="9" class="board-center" style="text-align: center; vertical-align: middle;">
                <div style="font-size: 16px;">Bank</div>
                <div style="font-size: 12px; margin-top: 5px;">Banker keeps money, property cards, and houses/hotels here</div>
            </td>
            <td class="cell board-right" id="cell35">
                <div class="cell-name">{{ $game->getSquare(35)['name'] }}</div>
            </td>
        </tr>
        <tr>
            <td class="cell board-left" id="cell14">
                <div class="cell-name">{{ $game->getSquare(14)['name'] }}</div>
            </td>
            <td colspan="9" class="board-center" style="text-align: center; vertical-align: middle;">
                <div style="font-size: 16px;">Free Parking</div>
                <div style="font-size: 12px; margin-top: 5px;">Collect fines and taxes here</div>
            </td>
            <td class="cell board-right" id="cell36">
                <div class="cell-name">{{ $game->getSquare(36)['name'] }}</div>
            </td>
        </tr>
        <tr>
            <td class="cell board-left" id="cell13">
                <div class="cell-name">{{ $game->getSquare(13)['name'] }}</div>
            </td>
            <td colspan="9" class="board-center" style="text-align: center; vertical-align: middle;">
                <div style="font-size: 16px;">Chance & Community Chest Cards</div>
                <div style="font-size: 12px; margin-top: 5px;">Place drawn cards here temporarily</div>
            </td>
            <td class="cell board-right" id="cell37">
                <div class="cell-name">{{ $game->getSquare(37)['name'] }}</div>
            </td>
        </tr>
        <tr>
            <td class="cell board-left" id="cell12">
                <div class="cell-name">{{ $game->getSquare(12)['name'] }}</div>
            </td>
            <td colspan="9" class="board-center" style="text-align: center; vertical-align: middle; height: 150px;">
                <div style="font-size: 20px; font-weight: bold;">JAIL</div>
                <div style="font-size: 12px; margin-top: 10px;">Just Visiting / In Jail</div>
            </td>
            <td class="cell board-right" id="cell38">
                <div class="cell-name">{{ $game->getSquare(38)['name'] }}</div>
            </td>
        </tr>
        <tr>
            <td class="cell board-left" id="cell11">
                <div class="cell-name">{{ $game->getSquare(11)['name'] }}</div>
            </td>
            <td colspan="9" class="board-center" style="text-align: center; vertical-align: middle;">
                <div style="font-size: 16px;">Mortgaged Properties</div>
                <div style="font-size: 12px; margin-top: 5px;">Place mortgaged property cards here</div>
            </td>
            <td class="cell board-right" id="cell39">
                <div class="cell-name">{{ $game->getSquare(39)['name'] }}</div>
            </td>
        </tr>
        <tr>
            <td class="cell board-corner" id="cell10">
                <div class="cell-name">{{ $game->getSquare(10)['name'] }}</div>
            </td>
            <td class="cell board-bottom" id="cell9">
                <div class="cell-name">{{ $game->getSquare(9)['name'] }}</div>
            </td>
            <td class="cell board-bottom" id="cell8">
                <div class="cell-name">{{ $game->getSquare(8)['name'] }}</div>
            </td>
            <td class="cell board-bottom" id="cell7">
                <div class="cell-name">{{ $game->getSquare(7)['name'] }}</div>
            </td>
            <td class="cell board-bottom" id="cell6">
                <div class="cell-name">{{ $game->getSquare(6)['name'] }}</div>
            </td>
            <td class="cell board-bottom" id="cell5">
                <div class="cell-name">{{ $game->getSquare(5)['name'] }}</div>
            </td>
            <td class="cell board-bottom" id="cell4">
                <div class="cell-name">{{ $game->getSquare(4)['name'] }}</div>
            </td>
            <td class="cell board-bottom" id="cell3">
                <div class="cell-name">{{ $game->getSquare(3)['name'] }}</div>
            </td>
            <td class="cell board-bottom" id="cell2">
                <div class="cell-name">{{ $game->getSquare(2)['name'] }}</div>
            </td>
            <td class="cell board-bottom" id="cell1">
                <div class="cell-name">{{ $game->getSquare(1)['name'] }}</div>
            </td>
            <td class="cell board-corner" id="cell0">
                <div class="cell-name">{{ $game->getSquare(0)['name'] }}</div>
            </td>
        </tr>
    </table>
</div>

<div style="text-align: center; margin-top: 30px; font-size: 12px; color: #666;">
    <p>{{ $game->getName() }} - Game Board</p>
    <p>Generated on {{ now()->format('M j, Y') }}</p>
</div>
@endsection
