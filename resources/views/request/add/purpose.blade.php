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
                        Request List
                    </h3>
                </div>
                <div class="card-body">
                    <div>
                        <table id="example1" class="table table-hover">
                            <thead class="bg-light">
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Type of Request</th>
                                    <th>Category</th>
                                    <th>Purpose</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                @php $no = 1; @endphp
                                @foreach($repurpose as $data)
                                <tr id="tr-{{ $data->purpose_Id }}">
                                    <td>{{ $no++ }}</td>
                                    <td>
                                        @php
                                            switch($data->type_request) {
                                                case 1:
                                                    echo 'PR';
                                                    break;
                                                case 2:
                                                    echo 'POW';
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
                                    <td>{{ $data->category_name }}</td>
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
                                    <td>
                                        <a href="{{ route('selectItems', encrypt($data->purpose_Id)) }}" class="btn btn-default green btn-sm btn-view">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button value="{{ $data->purpose_Id }}" class="btn btn-outline-danger btn-sm cart-delete">
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

<script>
    var mycartDeleteRoute = "{{ route('mycartDelete', ':id') }}";
</script>

@endsection