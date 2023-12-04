@php
    $current_route=request()->route()->getName();
@endphp

<div class="row pt-2 card">
    <div class="col-sm-12">
        <div>
            <a href="{{ route('dashboard') }}" class="btn btn-app {{$current_route=='dashboard'?'active':''}}">
                <i class="fas fa-th"></i> Dashboard
            </a>
            
            <a href="{{ route('categoryRead') }}" class="btn btn-app {{ request()->is('view*') ? 'active' : '' }}">
                <i class="fas fa-list"></i> Manage
            </a>

            <a href="{{ route('prPurposeRequest') }}" class="btn btn-app {{ request()->is('request*') ? 'active' : '' }}">
                <i class="fas fa-server"></i> Request
            </a>
            @if(Auth::user()->role=='Administrator')
                <a href="{{ route('user_list') }}" class="btn btn-app {{$current_route=='user_list'?'active':''}}">
                    <i class="fas fa-users"></i> Users
                </a>
            @endif
            <a href="{{ route('user_settings') }}" class="btn btn-app {{$current_route=='user_settings'?'active':''}}">
                <i class="fas fa-cog"></i> Settings
            </a>

            <a href="{{ route('logout') }}" class="btn btn-app float-right">
                <i class="fas fa-sign-out-alt"></i> Sign Out
            </a>
        </div>
    </div>
</div>