@php
    $curr_route = request()->route()->getName();

    $createActive = in_array($curr_route, ['prPurposeRequest', 'prCreateRequest']) ? 'active' : '';
    $pendingActive = in_array($curr_route, ['pendingListRead', 'pendingListView']) ? 'active' : '';
    $pendingAllActive = in_array($curr_route, ['pendingAllListRead', 'pendingAllListView']) ? 'active' : '';
    $approvedActive = in_array($curr_route, ['approvedListRead', 'approvedListView']) ? 'active' : '';
    $approvedAllActive = in_array($curr_route, ['approvedListAllRead', 'approvedListView']) ? 'active' : '';
    $pdfprActive = in_array($curr_route, ['PDFprRead']) ? 'active' : '';
    $pdfbarsActive = in_array($curr_route, ['PDFbarsRead']) ? 'active' : '';

@endphp

<h5 class="card-title ml-2 mr-2 mt-3" style="border-bottom: 1px solid #04401f; font-size: 14pt">
    Request
</h5>
<div class="ml-2 mr-2 mt-3 mb-3">
    <ul class="list-group">
        <a href="{{ route('prPurposeRequest') }}" class="list-group-item {{ $createActive }}">Create New PR</a>
        <a href="{{ route('pendingListRead') }}" class="list-group-item  {{ $pendingActive }}">
            <span id="pendingUserCount" class="badge badge-warning float-right mt-1">{{ $data['pendUserCount'] }}</span>Pending PR
        </a>
        <a href="{{ route('approvedListRead') }}" class="list-group-item {{ $approvedActive }}">Approved PR</a>
    </ul>
</div>

@if(Auth::user()->role=='Budget Officer' || Auth::user()->role=='Procurement Officer')
    <h5 class="card-title ml-2 mr-2 mt-3" style="border-bottom: 1px solid #04401f; font-size: 14pt">
        Offices Request
    </h5>
    <div class="ml-2 mr-2 mt-3 mb-3">
        <ul class="list-group">
            <a href="{{ route('pendingAllListRead') }}" class="list-group-item  {{ $pendingAllActive }}">Pending PR 
                <span id="pendingCount" class="badge badge-warning float-right mt-1">{{ $data['pendCount'] }}</span>
            </a>
            <a href="{{ route('approvedListAllRead') }}" class="list-group-item {{ $approvedAllActive }}">Approved PR</a>
        </ul>
    </div>
@endif

<h5 class="card-title ml-2 mr-2 mt-3" style="border-bottom: 1px solid #04401f; font-size: 14pt">
    Forms
</h5>
<div class="ml-2 mr-2 mt-3 mb-3">
    <ul class="list-group">
        <a href="" class="list-group-item">PR Form</a>
        <a href="{{ route('PDFbarsRead') }}" class="list-group-item {{ $pdfbarsActive }}">RBARA Slip</a>
    </ul>
</div>

<script>
    var allPendingCountRoute = "{{ route('pendingAllListRead') }}";
    var userPendingCountRoute = "{{ route('pendingListRead') }}";
</script>

