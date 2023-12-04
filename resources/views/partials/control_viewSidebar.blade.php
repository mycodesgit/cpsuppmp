@php
    $curr_route = request()->route()->getName();

    $categoryActive = in_array($curr_route, ['categoryRead', 'categoryEdit']) ? 'active' : '';
    $unitActive = in_array($curr_route, ['unitRead', 'unitEdit']) ? 'active' : '';
    $itemActive = in_array($curr_route, ['itemRead', 'itemEdit']) ? 'active' : '';
    $officeActive = in_array($curr_route, ['officeRead', 'officeEdit']) ? 'active' : '';
@endphp


<h5 class="card-title ml-2 mr-2 mt-3" style="border-bottom: 1px solid #04401f; font-size: 14pt">
    View list
</h5>
<div class="ml-2 mr-2 mt-3 mb-3">
    <ul class="list-group">
        <a href="{{ route('categoryRead') }}" class="list-group-item {{ $categoryActive }}">Category</a>
        <a href="{{ route('unitRead') }}" class="list-group-item  {{ $unitActive }}">Units</a>
        <a href="{{ route('itemRead') }}" class="list-group-item {{ $itemActive }}">Items</a>
        <a href="{{ route('officeRead') }}" class="list-group-item {{ $officeActive }}">Offices</a>
    </ul>
</div>

{{-- <div class="ml-2 mr-2 mt-3 mb-3">
    <ul class="list-group">
        <a href="{{ route('categoryRead') }}" class="list-group-item {{ $categoryActive }}">Category</a>
        <a href="{{ route('unitRead') }}" class="list-group-item {{ $unitActive }}">Units</a>  
        <a href="{{ route('itemRead') }}" class="list-group-item {{ $itemActive }}">Items</a>
        <a href="{{ route('officeRead') }}" class="list-group-item {{ $officeActive }}">Offices</a>
    </ul>
</div> --}}
