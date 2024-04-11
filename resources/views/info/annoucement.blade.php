@extends('layouts.master')

@section('body')
<div class="container-fluid">
    <div class="row" style="padding-top: 100px;">
        <div class="col-lg-2">
            <div class="card">
                @include('partials.control_settingsSidebar')
            </div>
        </div>
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('annouceUpdate') }}" class="form-horizontal" method="post" id="purposepr">
                        @csrf
                        
                        <input type="hidden" name="id" value="{{ $annoucement->id }}">

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label>Annoucement:</label>
                                    <textarea class="form-control form-control-sm" name="announcement" rows="4" oninput="var words = this.value.split(' '); for(var i = 0; i < words.length; i++){ words[i] = words[i].substr(0,1).toUpperCase() + words[i].substr(1); } this.value = words.join(' ');">{{ $annoucement->announcement }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-4">
                                    <label>Date Start:</label>
                                    <input type="date" name="datestart" class="form-control form-control-sm" value="{{ $annoucement->datestart }}">
                                </div>
                                <div class="col-md-4">
                                    <label>Date End:</label>
                                    <input type="date" name="dateend" class="form-control form-control-sm" value="{{ $annoucement->dateend }}">
                                </div>
                                <div class="col-md-4">
                                    <label>Status</label>
                                    <select class="form-control form-control-sm" name="status">
                                        <option disabled selected> --Select-- </option>
                                        <option value="1" {{ $annoucement->status == '1' ? 'selected="selected"' : '' }}>Off</option>
                                        <option value="2" {{ $annoucement->status == '2' ? 'selected="selected"' : '' }}>On</option>
                                    </select>
                                </div>
                            </div>
                        </div>  
                        
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <button type="reset" class="btn btn-danger">
                                        Clear
                                    </button>
                                    <button type="submit" name="btn-submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Save
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
@endsection