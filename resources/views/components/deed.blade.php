@props(['property'])

@php
    $isProperty = $property['groupNumber'] > 0 && $property['groupNumber'] < 3;
    $isRailroad = $property['groupNumber'] === 1;
    $isUtility = $property['groupNumber'] === 2;
@endphp

<div id="deed">
    @if($isProperty)
        <div id="deed-normal" style="display: none;">
            <div id="deed-header" style="background-color: {{ $property['color'] }};">
                <div style="margin: 5px; font-size: 11px;">T I T L E&nbsp;&nbsp;D E E D</div>
                <div id="deed-name">{{ $property['name'] }}</div>
            </div>
            <table id="deed-table">
                <tr>
                    <td colspan="2">
                        RENT&nbsp;$<span id="deed-baserent">{{ $property['baserent'] }}</span>.
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left;">With 1 House</td>
                    <td style="text-align: right;">$&nbsp;&nbsp;&nbsp;<span id="deed-rent1">{{ $property['rent1'] }}</span>.</td>
                </tr>
                <tr>
                    <td style="text-align: left;">With 2 Houses</td>
                    <td style="text-align: right;"><span id="deed-rent2">{{ $property['rent2'] }}</span>.</td>
                </tr>
                <tr>
                    <td style="text-align: left;">With 3 Houses</td>
                    <td style="text-align: right;"><span id="deed-rent3">{{ $property['rent3'] }}</span>.</td>
                </tr>
                <tr>
                    <td style="text-align: left;">With 4 Houses</td>
                    <td style="text-align: right;"><span id="deed-rent4">{{ $property['rent4'] }}</span>.</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div style="margin-bottom: 8px;">With HOTEL $<span id="deed-rent5">{{ $property['rent5'] }}</span>.</div>
                        <div>Mortgage Value $<span id="deed-mortgage">{{ intval($property['price'] / 2) }}</span>.</div>
                        <div>Houses cost $<span id="deed-houseprice">{{ $property['houseprice'] ?? 0 }}</span>. each</div>
                        <div>Hotels, $<span id="deed-hotelprice">{{ ($property['houseprice'] ?? 0) }}</span>. plus 4 houses</div>
                        <div style="font-size: 9px; font-style: italic; margin-top: 5px;">If a player owns ALL the Lots of any Color-Group, the rent is Doubled on Unimproved Lots in that group.</div>
                    </td>
                </tr>
            </table>
        </div>
    @elseif($isRailroad)
        <div id="deed-special">
            <div id="deed-special-name">{{ $property['name'] }}</div>
            <div id="deed-special-text">
                Rent $25.<br />
                If 2 Railroads are owned $50.<br />
                If 3&nbsp;&nbsp; " &nbsp;&nbsp; " &nbsp;&nbsp; " $100.<br />
                If 4&nbsp;&nbsp; " &nbsp;&nbsp; " &nbsp;&nbsp; " $200.
            </div>
            <div id="deed-special-footer">
                Mortgage Value
                <span style="float: right;">$<span id="deed-special-mortgage">{{ intval($property['price'] / 2) }}</span>.</span>
            </div>
        </div>
    @elseif($isUtility)
        <div id="deed-special">
            <div id="deed-special-name">{{ $property['name'] }}</div>
            <div id="deed-special-text">
                If one "Utility" is owned rent is 4 times amount shown on dice.<br /><br />
                If both "Utilitys" are owned rent is 10 times amount shown on dice.
            </div>
            <div id="deed-special-footer">
                Mortgage Value
                <span style="float: right;">$<span id="deed-special-mortgage">{{ intval($property['price'] / 2) }}</span>.</span>
            </div>
        </div>
    @endif

    <div id="deed-mortgaged">
        <div id="deed-mortgaged-name"></div>
        <p>&bull;</p>
        <div>MORTGAGED</div>
        <div> for $<span id="deed-mortgaged-mortgage">{{ intval($property['price'] / 2) }}</span></div>
        <p>&bull;</p>
        <div style="font-style: italic; font-size: 13px; margin: 10px;">Card must be turned this side up if property is mortgaged</div>
    </div>
</div>
