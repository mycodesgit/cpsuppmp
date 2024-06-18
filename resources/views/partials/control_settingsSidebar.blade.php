@php
    $curr_route = request()->route()->getName();

    $infoacntActive = in_array($curr_route, ['user_settings']) ? 'active' : '';
    $annouce2Active = in_array($curr_route, ['annouceInfo']) ? 'active' : '';
    $serverActive = in_array($curr_route, ['serverMaintenance']) ? 'active' : '';
@endphp


<h5 class="card-title ml-2 mr-2 mt-3" style="border-bottom: 1px solid #04401f; font-size: 14pt">
    Settings Menu
</h5>
<div class="ml-2 mr-2 mt-3 mb-3">
    <ul class="list-group">
        <a href="{{ route('user_settings') }}" class="list-group-item {{ $infoacntActive }}">Account Info</a>
        @if(Auth::user()->role=='Administrator' || Auth::user()->role=='Procurement Officer' || Auth::user()->role=='Checker')
            <a href="{{ route('annouceInfo') }}" class="list-group-item {{ $annouce2Active }}">Annoucement</a>
        @endif
        @if(Auth::user()->role=='Administrator')
            <a href="{{ route('serverMaintenance') }}" class="list-group-item {{ $serverActive }}">Server</a>
        @endif
    </ul>
</div>
