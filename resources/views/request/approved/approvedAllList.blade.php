@extends('layouts.master')

@section('body')
<div class="container-fluid">
    <div class="row" style="padding-top: 100px;">
        <div class="col-lg-2">
            <div class="card">
                @if(Auth::user()->role=='Budget Officer')
                    @include('partials.control_requestBudSidebar')
                @else
                    @include('partials.control_requestSidebar')
                @endif
            </div>
        </div>
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        List of Approved Purchase Request
                    </h3>
                </div>
                <div class="card-body">
                    <div class="">
                        <table id="prapproved" class="table  table-hover">
                            <thead>
                                <tr>
                                    <th>Campus</th>
                                    <th>PR No.</th>
                                    <th>Type of Request</th>
                                    <th>Office</th>
                                    <th>Purpose</th>
                                    <th>Category</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var allApprovedRoute = "{{ route('getAllapprovedListRead') }}";
    var approvedAllListViewRoute = '{{ route('approvedAllListView', '') }}';
    var approvedReceivedViewRoute = '{{ route('receivedPR') }}';
    var approvedPurchasedViewRoute = '{{ route('purchasedPR') }}';

    var userRole = '{{ Auth::user()->role }}';
</script>
@endsection