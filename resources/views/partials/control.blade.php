@php
    $current_route=request()->route()->getName();
@endphp

<div class="row pt-2 card" style="background-color: #6c9076">
    <div class="col-sm-12">
        <div>
            <a href="{{ route('dashboard') }}" class="btn btn-app {{$current_route=='dashboard'?'active':''}}">
                <i class="fas fa-th"></i> Dashboard
            </a>
            @if(Auth::user()->role=='Administrator' || Auth::user()->role=='Procurement Officer' || Auth::user()->role=='Checker')
            <a href="{{ route('categoryRead') }}" class="btn btn-app {{ request()->is('view*') ? 'active' : '' }}">
                <i class="fas fa-list"></i> Manage
            </a>
            @endif

            @if(Auth::user()->role=='Administrator' || Auth::user()->role=='Budget Officer' || Auth::user()->role=='Procurement Officer' || Auth::user()->role=='Campus Admin' || Auth::user()->role=='Dean' || Auth::user()->role=='Office Head')
                <a href="{{ route('shop') }}" class="btn btn-app {{ request()->is('request*') ? 'active' : '' }}">
                    <i class="fas fa-server"></i> Request
                </a>
            @endif

            @if(Auth::user()->role=='Budget Officer')
                <a href="{{ route('pendingAllBudgetListRead') }}" class="btn btn-app {{ request()->is('view-request*') ? 'active' : '' }}">
                    <i class="fas fa-share-nodes"></i> View Req.
                </a>
            @endif

            @if(Auth::user()->role=='Checker')
                <a href="{{ route('pendingAllListRead') }}" class="btn btn-app {{ request()->is('request*') ? 'active' : '' }}">
                    <i class="fas fa-server"></i> Request
                </a>

                <a href="{{ route('ppmpRead') }}" class="btn btn-app {{ request()->is('ppmp*') ? 'active' : '' }}">
                    <i class="fas fa-server"></i> PPMP
                </a>
            @endif

            @if(Auth::user()->role=='Administrator' || Auth::user()->role=='Procurement Officer' || Auth::user()->role=='Checker')
                <a href="{{ route('consolidateRead') }}" class="btn btn-app {{ request()->is('generate*') ? 'active' : '' }}">
                    <i class="fas fa-file-pdf"></i> Reports
                </a>
            @endif

            @if(Auth::user()->role=='Administrator' || Auth::user()->role=='Checker')
                <a href="{{ route('userRead') }}" class="btn btn-app {{ request()->is('users*') ? 'active' : '' }}">
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