@extends('layouts.master')

@section('body')

@php $cr = request()->route()->getName(); @endphp

<div class="container-fluid">
    <div class="row" style="padding-top: 100px;">
        <div class="col-lg-2">
            <div class="card">
                @include('partials.control_viewSidebar')
            </div>
        </div>
        <div class="col-lg-7">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-hover text-sm">
                            <thead>
                                <tr>
                                    <th width="10">No</th>
                                    <th>Cateogry</th>
                                    <th width="10">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach($unit as $data)
                                <tr id="tr-{{ $data->id }}" class="{{ $cr === 'unitEdit' ? $data->id == $selectedUnit->id ? 'bg-selectEdit' : '' : ''}}">
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data->unit_name }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-success dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a href="{{ route('unitEdit', $data->id) }}" class="dropdown-item btn-edit" data-id="{{ $data->id }}">
                                                        <i class="fas fa-exclamation-circle"></i> Edit
                                                    </a>
                                                    <button value="{{ $data->id }}" class="dropdown-item unit-delete">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="fas fa-{{ $cr == 'unitEdit' ? 'pen' : 'plus'}}"></i> {{ $cr == 'unitEdit' ? 'Edit' : 'Add'}}
                    </h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ $cr == 'unitEdit' ? route('unitUpdate', ['id' => $selectedUnit->id]) : route('unitCreate') }}" method="post" id="unit">
                        @csrf
                        @if ($cr == 'unitEdit')
                            <input type="hidden" name="id" value="{{ $selectedUnit->id }}">
                        @endif
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label>Unit:</label>
                                    <input type="text" name="unit_name" value="{{ $cr === 'unitEdit' ? $selectedUnit->unit_name : '' }}" oninput="var words = this.value.split(' '); for(var i = 0; i < words.length; i++){ words[i] = words[i].substr(0,1).toUpperCase() + words[i].substr(1); } this.value = words.join(' ');" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <button type="#" class="btn btn-success">
                                        <i class="fas fa-save"></i> {{ $cr == 'unitEdit' ? 'Update' : 'Add'}}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var unitDeleteRoute = "{{ route('unitDelete', ':id') }}";
</script>
@endsection