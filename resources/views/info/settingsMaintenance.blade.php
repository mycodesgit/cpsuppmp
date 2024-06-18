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
                    <form method="post" action="{{ route('toggleMaintenance') }}" id="">
                        @csrf

                        <div class="alert alert-secondary alert-dismissible">
                            <div class="form-group mt-3">
                                <div class="form-row">
                                    <div class="col-8">
                                        <div class="icheck-warning">
                                            <input type="checkbox" id="maintenance" name="maintenance_mode"  {{ $maintenance_mode ? 'checked' : '' }}>
                                            <label for="maintenance">
                                                <h3 style="margin-top: -5px">Maintenance Mode</h3>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h5><i class="icon fas fa-exclamation-triangle text-warning"></i>Note!</h5>
                            <span class="text-warning">Check the checkbox if you want a server maintenance</span>
                        </div>

                        @auth('web')
                            @if(Auth::guard('web')->user()->role == 'Administrator')
                            <div class="form-group mt-2">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <label>&nbsp;</label>
                                        <button type="submit" class="btn btn-primary btn-lg">Save</button>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endauth
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection