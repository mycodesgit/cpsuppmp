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
                    <div class="table-responsive">
                        @if(request()->route()->getName() == 'approvedListAllRead')
                            <table id="example1" class="table  table-hover">
                        @else
                            <table id="prapproved" class="table  table-hover">
                        @endif
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Receipt Control</th>
                                    <th>Type of Request</th>
                                    <th>Office</th>
                                    <th>Purpose</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $currentRoute = request()->route()->getName();
                                @endphp

                                @if ($currentRoute == 'approvedListAllRead')

                                    @php $no = 1; @endphp
                                    @foreach($reqitempurpose as $data)
                                    <tr id="tr-{{ $data->id }}">
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $data->receipt_control }}</td>
                                            <td>
                                                @php
                                                    switch($data->type_request) {
                                                        case 1:
                                                            echo 'Purchase Request</span>';
                                                            break;
                                                        case 2:
                                                            echo 'POW</span>';
                                                            break;
                                                        case 3:
                                                            echo 'Letter Request';
                                                            break;
                                                        case 4:
                                                            echo 'Others';
                                                            break;
                                                        default:
                                                            echo 'Unknown';
                                                    }
                                                @endphp
                                            </td>
                                        <td>{{ $data->office_abbr }}</td>
                                        <td>{{ $data->purpose_name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($data->created_at)->format('F j, Y') }}</td>
                                        <td>
                                            @php
                                                switch($data->pstatus) {
                                                    case 7:
                                                        echo '<span class="badge badge-success">PR has been Approved</span>';
                                                        break;
                                                    default:
                                                        echo '<span class="badge badge-secondary">Unknown Status</span>';
                                                }
                                            @endphp
                                        </td>

                                        </td>
                                        <td>
                                            @php
                                                $currentRoute = request()->route()->getName();
                                            @endphp

                                            @if ($currentRoute == 'approvedListAllRead')
                                                <a href="{{ route('approvedAllListView', encrypt($data->pid)) }}" class="btn btn-info btn-xs btn-edit">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                </a>
                                            @elseif ($currentRoute == 'approvedListRead')
                                                <a href="{{ route('approvedListView', encrypt($data->pid)) }}" class="btn btn-info btn-xs btn-edit">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                </a>
                                            @else
                                                <a href="{{ route('approvedAllListView', encrypt($data->pid)) }}" class="btn btn-info btn-xs btn-edit">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach

                                @elseif ($currentRoute == 'approvedListRead')

                                @else
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var allApprovedRoute = "{{ route('getapprovedListRead') }}";
    var approvedListViewRoute = '{{ route('approvedListView', '') }}';
</script>
@endsection