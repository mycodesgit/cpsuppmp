@extends('layouts.master')

@section('body')

@php $cr = request()->route()->getName(); @endphp

<div class="container-fluid">
    <div class="row" style="padding-top: 100px;">
        <div class="col-lg-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title" style="font-size: 17pt"></h5>
                    @include('partials.control_viewSidebar')
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Office Name</th>
                                    <th>Abbreviation</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach($office as $data)
                                <tr id="tr-{{ $data->id }}" class="{{ $cr === 'officeEdit' ? $data->id == $selectedOffice->id ? 'bg-selectEdit' : '' : ''}}">
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data->office_name }}</td>
                                    <td>{{ $data->office_abbr }}</td>
                                    <td>
                                        <a href="{{ route('officeEdit', $data->id) }}" class="btn btn-info btn-xs btn-edit" data-id="{{ $data->id }}">
                                            <i class="fas fa-exclamation-circle"></i>
                                        </a>
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
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="fas fa-{{ $cr == 'officeEdit' ? 'pen' : 'plus'}}"></i> {{ $cr == 'officeEdit' ? 'Edit' : 'Add'}}
                    </h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ $cr == 'officeEdit' ? route('officeUpdate', ['id' => $selectedOffice->id]) : route('officeCreate') }}" method="post" id="office">
                        @csrf
                        @if ($cr == 'officeEdit')
                            <input type="hidden" name="id" value="{{ $selectedOffice->id }}">
                        @endif
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label>Office Name:</label>
                                    <input type="text" name="office_name" value="{{ $cr === 'officeEdit' ? $selectedOffice->office_name : '' }}" oninput="var words = this.value.split(' '); for(var i = 0; i < words.length; i++){ words[i] = words[i].substr(0,1).toUpperCase() + words[i].substr(1); } this.value = words.join(' ');" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label>Abbreviation:</label>
                                    <input type="text" name="office_abbr" value="{{ $cr === 'officeEdit' ? $selectedOffice->office_abbr : '' }}" oninput="this.value = this.value.toUpperCase()" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <button type="#" class="btn btn-success">
                                        <i class="fas fa-save"></i> {{ $cr == 'officeEdit' ? 'Update' : 'Add'}}
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
    var officeDeleteRoute = "{{ route('officeDelete', ':id') }}";
</script>
@endsection