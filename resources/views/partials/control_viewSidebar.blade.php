@php
    $curr_route = request()->route()->getName();

    $categoryActive = in_array($curr_route, ['categoryRead', 'categoryEdit']) ? 'active' : '';
    $unitActive = in_array($curr_route, ['unitRead', 'unitEdit']) ? 'active' : '';
    $itemActive = in_array($curr_route, ['itemRead', 'itemEdit']) ? 'active' : '';
    $officeActive = in_array($curr_route, ['officeRead', 'officeEdit']) ? 'active' : '';
@endphp

<ul class="nav nav-pills flex-column">
    <li class="nav-item">
        <a href="{{ route('categoryRead') }}" class="nav-link2 {{ $categoryActive }}" style="color: #000;">
            Category
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('unitRead') }}" class="nav-link2 {{ $unitActive }}" style="color: #000;">
            Unit
        </a>
    </li>

    
    <li class="nav-item">
        <a href="{{ route('itemRead') }}" class="nav-link2 {{ $itemActive }}" style="color: #000;">
            Items
        </a>
    </li>
    
    <li class="nav-item">
        <a href="{{ route('officeRead') }}" class="nav-link2 {{ $officeActive }}" style="color: #000;">
            Offices
        </a>
    </li>
</ul>