@props(['square', 'index'])

@php
    $isCorner = in_array($index, [0, 10, 20, 30]);
    $isProperty = $square['groupNumber'] > 0 && $square['price'] > 0;
    $isRailroad = $square['groupNumber'] === 1;
    $isUtility = $square['groupNumber'] === 2;
    $hasColor = $square['color'] !== '#FFFFFF' && $square['color'] !== 'white';
@endphp

<div class="cell-anchor">
    <div class="cell-position-holder" id="cell{{ $index }}positionholder">
        {{-- Player tokens will be added here dynamically --}}
    </div>

    <div class="cell-name" id="cell{{ $index }}name">
        @if($index === 1)
            {{-- Special handling for Mediterranean Avenue --}}
            Mediter-ranean Avenue
        @else
            {{ $square['name'] }}
        @endif
    </div>

    @if($isProperty || $isRailroad || $isUtility)
        <div class="cell-owner" id="cell{{ $index }}owner"></div>
    @endif
</div>
