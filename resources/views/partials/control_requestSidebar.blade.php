@php
    $cur_reqSidebar_route=request()->route()->getName();
@endphp

<ul class="nav nav-pills flex-column">
    <li class="nav-item">
        <a href="{{ route('pending_list') }}" class="nav-link2 {{$cur_reqSidebar_route=='pending_list'?'active':''}}" style="color: #000;">
            <i class="fas fa-clock"></i> Pending Request
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('approved_list') }}" class="nav-link2 {{$cur_reqSidebar_route=='approved_list'?'active':''}}" style="color: #000;">
            <i class="fas fa-check"></i> Approved Request
        </a>
    </li>
</ul>