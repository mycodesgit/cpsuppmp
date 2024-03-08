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
                <div class="card-body">
                    @include('request.add.modal')
                    <div class="row">
                        @foreach($category as $data)
                            <div class="col-12 col-md-6 col-lg-4 mb-3">
                                <div class="p-lg-8 rounded" style="background: url('{{ asset($data->bgimg) }}') no-repeat; background-size: cover;">
                                    <div>
                                        <h3 class="mb-0 fw-bold">
                                            {{ $data->category_name }}
                                        </h3>
                                        <div class="mt-4 mb-5 fs-5">
                                            <p class="mb-0"><br></p>
                                            <span>
                                                <br>
                                                <span class="fw-bold text-dark"></span>
                                            </span>
                                        </div>
                                        <button type="button" class="btn btn-success btn-sm shop-btn" data-toggle="modal" data-target="#modal-purpose" data-category-id="{{ $data->id }}">Shop Now</button>
                                    </div>
                                </div>
                            </div>

                            @if($loop->iteration % 3 == 0 && !$loop->last)
                                </div><div class="row">
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection