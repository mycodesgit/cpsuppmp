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
                <div class="card-body">
                    <form action="{{ route('consolidateGenform2_reports') }}" class="form-horizontal add-form" id="form1Search" method="GET" target="">
                        @csrf
                        
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-2">
                                    <label>Date Start:</label>
                                    <input type="date" name="start_date" class="form-control form-control-sm">
                                </div>

                                <div class="col-md-2">
                                    <label>Date End:</label>
                                    <input type="date" name="end_date" class="form-control form-control-sm">
                                </div>

                                <div class="col-md-6">
                                    <label>Category:</label>
                                    <select  id="category-dropdown" name="cat_id" class="form-control form-control-sm">
                                        <option disabled selected>-- Select --</option>
                                        @foreach ($category as $cat)
                                            <option value="{{ $cat->id }}">
                                                {{ $cat->category_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <label>&nbsp;</label>
                                    <button type="submit" class="form-control form-control-sm btn btn-success btn-sm">Search</button>
                                </div>
                            </div>
                        </div>  
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection