@php
    $curr_route = request()->route()->getName();

    $pendingAllActive = in_array($curr_route, ['pendingAllBudgetListRead', 'pendingAllListView']) ? 'active' : '';
    $approvedActive = in_array($curr_route, ['approvedListAllRead', 'approvedListView']) ? 'active' : '';
    $approvedAllActive = in_array($curr_route, ['approvedListAllRead', 'approvedAllListView']) ? 'active' : '';

@endphp


@if(Auth::user()->role=='Budget Officer')
    <h5 class="card-title ml-2 mr-2 mt-3" style="border-bottom: 1px solid #04401f; font-size: 14pt">
        Offices Request
    </h5>
    <div class="ml-2 mr-2 mt-3 mb-3">
        <ul class="list-group">
            <a href="{{ route('pendingAllBudgetListRead') }}" class="list-group-item  {{ $pendingAllActive }}">Pending PR 
                <span id="pendingBudCount" class="badge badge-warning float-right mt-1">{{ $data['pendBudCount'] }}</span>
            </a>
            <a href="{{ route('approvedListAllRead') }}" class="list-group-item {{ $approvedAllActive }}">Approved PR
                <span id="approvedCount" class="badge badge-warning float-right mt-1">{{ $data['approvedCount'] }}</span>
            </a>
        </ul>
    </div>
@endif


<script>
    var allPendingCountRoute = "{{ route('pendingAllListRead') }}";
    var allPendingBudgetCountRoute = "{{ route('pendingAllBudgetListRead') }}";
    var userPendingCountRoute = "{{ route('pendingListRead') }}";
    var allApprovedCountRoute = "{{ route('approvedListAllRead') }}";
    var userApprovedCountRoute = "{{ route('approvedListRead') }}";
</script>


<script>
    var allPendingBudgetCountRoute = "{{ route('pendingAllBudgetListRead') }}";
</script>

