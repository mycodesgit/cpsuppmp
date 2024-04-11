@extends('layouts.master')

@section('body')
<div class="container-fluid">
    <div class="row" style="padding-top: 100px;">
        <div class="col-lg-2">
            <div class="card">
                @include('partials.control_requestBudSidebar')
            </div>
        </div>
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        List of Pending Purchase Request
                    </h3>
                </div>
                <div class="card-body">
                    <div class="">
                        <table id="bud" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Campus</th>
                                    <th>Transaction No.</th>
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

@if(request()->routeIs(['pendingAllBudgetListRead']))
    <script>
        var allPendingBudgetRoute = "{{ route('getpendingBudgetAllListRead') }}";
        var pendingAllListViewRoute = '{{ route('pendingAllListView', '') }}';
    </script>
@endif

@endsection