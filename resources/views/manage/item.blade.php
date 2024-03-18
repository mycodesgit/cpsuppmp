@extends('layouts.master')

@section('body')

@php $cr = request()->route()->getName(); @endphp

<style>
    .select2bs4-selection,
    .form-control1 {
        height: 35px !important;
    }
</style>
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
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Description</th>
                                    <th>Unit</th>
                                    <th>Price</th>
                                    <th>Category</th>
                                    @if($cr === 'itemRead')
                                    <th>Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @if($cr === 'itemEdit')
                                    @foreach([$editItem] as $data)
                                        <tr id="tr-{{ $data->itid }}" class="bg-selectEdit">
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $data->item_descrip }}</td>
                                            <td>{{ $data->unit_name }}</td>
                                            <td>{{ $data->item_cost }}</td>
                                            <td>{{ $data->category_name }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    @foreach($item as $data)
                                        <tr id="tr-{{ $data->itid }}">
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $data->item_descrip }}</td>
                                            <td>{{ $data->unit_name }}</td>
                                            <td>{{ $data->item_cost }}</td>
                                            <td>{{ $data->category_name }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-success dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a href="{{ route('itemEdit', ['id' => $data->itid]) }}" class="dropdown-item btn-edit" data-id="{{ $data->itid }}">
                                                                <i class="fas fa-exclamation-circle"></i> Edit
                                                            </a>
                                                            <button value="{{ $data->itid }}" class="dropdown-item item-delete">
                                                                <i class="fas fa-trash"></i> Delete
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
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
                        <i class="fas fa-{{ $cr == 'itemEdit' ? 'pen' : 'plus'}}"></i> {{ $cr == 'itemEdit' ? 'Edit' : 'Add'}}
                    </h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ $cr == 'itemEdit' ? route('itemUpdate', ['id' => $editItem->id]) : route('itemCreate') }}" method="post" id="item">
                        @csrf
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label>Category:</label>
                                    @if ($cr == 'itemEdit')
                                        <input type="hidden" name="id" value="{{ $editItem->id }}">
                                    @endif
                                    
                                    <select id="category" name="category_id" class="form-control select2bs4" data-placeholder="Select Category" style="width: 100%;">
                                        <option value="">-- Select --</option>
                                        @foreach ($category as $cat)
                                        <option value="{{ $cat->id }}" @if($cr === 'itemEdit' && $cat->id === $editItem->category_id) selected @endif>
                                            {{ $cat->category_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label>Unit:</label>
                                    <select id="unit" name="unit_id" class="form-control select2bs4" data-placeholder="Select Unit" style="width: 100%;">
                                        <option value="">-- Select --</option>
                                        @foreach ($unit as $u)
                                        <option value="{{ $u->id }}" @if($cr === 'itemEdit' && $u->id === $editItem->unit_id) selected @endif>
                                            {{ $u->unit_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label>Item Description:</label>
                                    <textarea rows="4" name="item_descrip" class="form-control" oninput="var words = this.value.split(' '); for(var i = 0; i < words.length; i++){ words[i] = words[i].substr(0,1).toUpperCase() + words[i].substr(1); } this.value = words.join(' ');">{{ $cr === 'itemEdit' ? $editItem->item_descrip : '' }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label>Item Cost:</label>
                                    <input type="text" name="item_cost" value="{{ $cr === 'itemEdit' ? $editItem->item_cost : '' }}" onkeyup="formatNumber(this);" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <button type="#" class="btn btn-success">
                                        <i class="fas fa-save"></i> {{ $cr == 'itemEdit' ? 'Update' : 'Add'}}
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
function formatNumber(input) {
    const value = input.value.replace(/[^\d.]/g, '');
    const formattedValue = value.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    input.value = formattedValue;
}
</script>

<script>
    var itemDeleteRoute = "{{ route('itemDelete', ':id') }}";
</script>
@endsection