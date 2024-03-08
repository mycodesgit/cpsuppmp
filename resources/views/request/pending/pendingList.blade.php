@extends('layouts.master')

@section('body')
<div class="container-fluid">
    <div class="row" style="padding-top: 100px;">
        <div class="col-lg-2">
            <div class="card">
                @include('partials.control_requestSidebar')
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
                        <table id="example1" class="table  table-hover">
                            <thead>
                                <tr>
                                    <th>Type of Request</th>
                                    <th>Office</th>
                                    <th>Purpose</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                    @php $no = 1; @endphp
                                    @foreach($reqitempurpose as $data)
                                    <tr id="tr-{{ $data->id }}">
                                        <td>
                                            @php
                                                switch($data->type_request) {
                                                    case 1:
                                                        echo 'PR</span>';
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
                                                    case 1:
                                                        echo '<span class="badge badge-info" style="font-size: 12px">Ongoing</span>';
                                                        break;
                                                    case 2:
                                                        echo '<span class="badge badge-warning" style="font-size: 12px">Pending in Procurement</span>';
                                                        break;
                                                    case 3:
                                                        echo '<span class="badge badge-danger" style="font-size: 12px">Returned to Client</span>';
                                                        break;
                                                    case 4:
                                                        echo '<span class="badge badge-success" style="font-size: 12px">Checking PR in Procurement</span>';
                                                        break;
                                                    case 5:
                                                        echo '<span class="badge badge-secondary" style="font-size: 12px">Verifying PR in PPMP</span>';
                                                        break;
                                                    case 6:
                                                        echo '<span class="badge badge-success">Pending in Budget Office</span>';
                                                        break;
                                                    default:
                                                        echo '<span class="badge badge-secondary">Unknown Status</span>';
                                                }
                                            @endphp
                                        </td>

                                        </td>
                                        <td>
                                            {{-- <a href="{{ route('pendingListView', encrypt($data->pid)) }}" class="btn btn-info btn-xs btn-edit">
                                                <i class="fas fa-exclamation-circle"></i>
                                            </a> --}}
                                            @php
                                                $currentRoute = request()->route()->getName();
                                            @endphp

                                            @if ($currentRoute == 'pendingListRead')
                                                <a href="{{ route('pendingListView', encrypt($data->pid)) }}" class="btn btn-secondary btn-xs btn-edit">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            @elseif ($currentRoute == 'pendingAllListRead')
                                                <a href="{{ route('pendingAllListView', encrypt($data->pid)) }}" class="btn btn-secondary btn-xs btn-edit">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            @else
                                                <a href="{{ route('pendingListView', encrypt($data->pid)) }}" class="btn btn-secondary btn-xs btn-edit">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            @endif


                                            <button value="{{ $data->id }}" class="btn btn-danger btn-xs item-delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(request()->routeIs(['pendingAllListRead']))
<script>
    var allPendingRoute = "{{ route('getpendingAllListRead') }}";
    var allPendingBudgetRoute = "{{ route('getpendingBudgetAllListRead') }}";
    var pendingAllListViewRoute = '{{ route('pendingAllListView', '') }}';
</script>
@endif

@endsection