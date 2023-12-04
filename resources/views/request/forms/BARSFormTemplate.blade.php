@extends('layouts.master')

@section('body')

@php $cr = request()->route()->getName(); @endphp

<div class="container-fluid">
    <div class="row" style="padding-top: 100px;">
        <div class="col-lg-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title" style="font-size: 17pt"></h5>
                    @include('partials.control_requestSidebar')
                </div>
            </div>
        </div>
        <div class="col-lg-10">
            <div class="card">
                <div class="card-body">
                    <iframe src="{{ route('PDFbarsShowTemplate') }}" width="100%" height="510"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection