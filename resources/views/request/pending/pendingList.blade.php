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
                    <div class="table-responsive">
                        @if(request()->route()->getName() == 'pendingListRead')
                            <table id="example1" class="table  table-hover">
                        @else
                            <table id="example" class="table  table-hover">
                        @endif
                            <thead>
                                <tr>
                                    <th>#</th>
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

                                @if ($currentRoute == 'pendingListRead')

                                    @php $no = 1; @endphp
                                    @foreach($reqitempurpose as $data)
                                    <tr id="tr-{{ $data->id }}">
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $data->office_abbr }}</td>
                                        <td>{{ $data->purpose_name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($data->created_at)->format('F j, Y') }}</td>
                                        <td>
                                            @php
                                                switch($data->pstatus) {
                                                    case 1:
                                                        echo '<span class="badge badge-info">Ongoing</span>';
                                                        break;
                                                    case 2:
                                                        echo '<span class="badge badge-warning">Pending</span>';
                                                        break;
                                                    case 3:
                                                        echo '<span class="badge badge-danger">Decline</span>';
                                                        break;
                                                    case 4:
                                                        echo '<span class="badge badge-success">Accepted</span>';
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
                                                <a href="{{ route('pendingListView', encrypt($data->pid)) }}" class="btn btn-info btn-xs btn-edit">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                </a>
                                            @elseif ($currentRoute == 'pendingAllListRead')
                                                <a href="{{ route('pendingAllListView', encrypt($data->pid)) }}" class="btn btn-info btn-xs btn-edit">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                </a>
                                            @else
                                                <a href="{{ route('pendingListView', encrypt($data->pid)) }}" class="btn btn-info btn-xs btn-edit">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                </a>
                                            @endif


                                            <button value="{{ $data->id }}" class="btn btn-danger btn-xs item-delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach

                                @elseif ($currentRoute == 'pendingAllListRead')

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
    var allPendingRoute = "{{ route('getpendingAllListRead') }}";
    var pendingAllListViewRoute = '{{ route('pendingAllListView', '') }}';
</script>
@endsection