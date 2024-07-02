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
                                        {{-- <a href="{{ route('selectItems', encrypt($data->purpose_Id)) }}" class="btn btn-default green btn-sm btn-view">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button value="{{ $data->purpose_Id }}" class="btn btn-outline-danger btn-sm cart-delete">
                                            <i class="fas fa-trash"></i>
                                        </button> --}}

                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default green btn-md dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                            <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu" role="menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(68px, -165px, 0px);">
                                                <a href="{{ route('selectItems', encrypt($data->purpose_Id)) }}" class="dropdown-item">
                                                    <i class="fas fa-eye"></i> View
                                                </a>
                                                <button class="dropdown-item" data-toggle="modal" data-target="#modal-editpurpose-{{ $data->purpose_Id }}" data-purpose="{{ $data->purpose_name }}">
                                                    <i class="fas fa-pen"></i> Edit
                                                </button>
                                                <button class="dropdown-item cart-delete" value="{{ $data->purpose_Id }}">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade" id="modal-editpurpose-{{ $data->purpose_Id }}" role="dialog" aria-labelledby="editPurposeLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-md" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h6 class="modal-title">
                                                    <i class="fas fa-pen"></i> Edit
                                                </h6>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            
                                            <form action="{{ route('prPurposeRequestUpdate') }}" class="form-horizontal" method="post" id="purposepr">
                                                @csrf
                                                <div class="modal-body">
                                                    <input type="hidden" name="id" value="{{ $data->purpose_Id }}">

                                                    <div class="form-group">
                                                        <div class="form-row">
                                                            <div class="col-md-12">
                                                                <label>Purpose:</label>
                                                                <textarea name="purpose_name" rows="4" class="form-control" oninput="var words = this.value.split(' '); for(var i = 0; i < words.length; i++){ words[i] = words[i].substr(0,1).toUpperCase() + words[i].substr(1); } this.value = words.join(' ');">{{ $data->purpose_name }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>    
                                                </div>
                                            
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-default green">Save changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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