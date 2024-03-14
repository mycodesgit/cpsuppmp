@extends('layouts.master')

@section('body')
<div class="container-fluid">
    <div class="row" style="padding-top: 100px;">
        <div class="col-lg-2">
            <div class="card">
                @include('partials.control_reportSidebar')
            </div>
        </div>
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Reports
                    </h3>
                </div>
                <form method="POST" action="{{ route('consolidatePDFGenform2_reports') }}" id="" target="_blank">
                    {{ csrf_field() }}

                    <div class="container">
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-2">
                                    <label>&nbsp;</label>
                                    <button type="submit" class="form-control form-control-sm btn btn-info btn-sm">Generate PDF</button>
                                </div>

                                <div class="col-md-2">
                                    <input type="hidden" name="start_date" value="{{ request('start_date') }}" class="form-control form-control-sm">
                                </div>

                                <div class="col-md-2">
                                    <input type="hidden" name="end_date" value="{{ request('end_date') }}" class="form-control form-control-sm">
                                </div>

                                <div class="col-md-3">
                                    <input type="hidden" name="cat_id" value="{{ request('cat_id') }}" class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Unit</th>
                                    <th>Item Description</th>
                                    <th>End User</th>
                                    <th>Qty</th>
                                    <th>Unit Cost</th>
                                    <th>Total Cost</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                @php $no = 1; @endphp
                                @foreach($itemConsolidate as $data)
                                <tr id="tr-{{ $data->uid }}">
                                    <td width="10">{{ $no++ }}</td>
                                    <td>{{ $data->unit_name }}</td>
                                    <td>{{ $data->item_descrip }}</td>
                                    <td>{{ $data->office_abbr }}</td>
                                    <td>{{ $data->qty }}</td>
                                    <td>{{ $data->item_cost }}</td>
                                    <td>{{ number_format($data->total_cost, 2) }}</td>
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



@endsection