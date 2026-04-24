<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Monopoly') }} - Print</title>

    <!-- Print-specific styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/print.css') }}" media="print" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}" />

    <style>
        @media print {
            body { margin: 0; }
            .no-print { display: none !important; }
            .page-break { page-break-before: always; }
        }
    </style>
</head>
<body>
    <div class="no-print" style="text-align: center; margin: 20px; padding: 10px; border: 1px solid #ccc;">
        <h2>Print Preview</h2>
        <p>Use your browser's print function (Ctrl+P / Cmd+P) to print this page.</p>
        <button onclick="window.print()" style="padding: 10px 20px; font-size: 16px;">Print Now</button>
        <br><br>
        <a href="{{ route('game.show', request()->route('gameId')) }}">← Back to Game</a> |
        <a href="{{ route('splash') }}">Game Selection</a>
    </div>

    @yield('content')
</body>
</html>
