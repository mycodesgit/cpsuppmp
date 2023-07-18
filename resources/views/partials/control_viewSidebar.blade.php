@php
    $cur_viewSidebar_route=request()->route()->getName();
@endphp

<ul class="nav nav-pills flex-column">
    <li class="nav-item">
        <a href="{{ route('category_list') }}" class="nav-link2 {{$cur_viewSidebar_route=='category_list'?'active':''}}" style="color: #000;">
            Category
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('unit_list') }}" class="nav-link2 {{$cur_viewSidebar_route=='unit_list'?'active':''}}" style="color: #000;">
            Unit
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('item_list') }}" class="nav-link2 {{$cur_viewSidebar_route=='item_list'?'active':''}}" style="color: #000;">
            Item List
        </a>
    </li>
    
    <li class="nav-item">
        <a href="{{ route('office_list') }}" class="nav-link2 {{$cur_viewSidebar_route=='office_list'?'active':''}}" style="color: #000;">
            Offices
        </a>
    </li>
</ul>