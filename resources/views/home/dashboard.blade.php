@extends('layouts.master')

@section('body')
<div class="container-fluid">
    <div class="row" style="padding-top: 100px;">
        {{-- <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $userCount }}</h3>
                            <p>Users</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-secondary">
                        <div class="inner">
                            <h3>{{ $offCount }}</h3>
                            <p>Offices</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-building"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $campusCount }}</h3>
                            <p>Campuses</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-map-marker"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>0</h3>
                            <p>Property Type</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-gear"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="col-lg-12">
            <div class="bg-welcome d-lg-flex justify-content-between align-items-center py-6 py-lg-3 px-8 text-center text-lg-start rounded">
                <div class="d-lg-flex align-items-center">
                    <img src="{{ asset('template/img/icons8-basket-96.png') }}" alt="" class="img-fluid" style="margin-left: 50px" width="100" />
                    <div class="">
                        <h1 class="" style="text-align: left;">Welcome to CPSU Purchase Request</h1>
                        <span style="text-align: left; font-family: Bookman Old Style;">
                            Streamline your purchasing process with this <span class="text-primary">Platform</span>. Submit your requests effortlessly and <b>ensure a smooth procurement experience.</b>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        @php
            $currentDate = now()->format('Y-m-d');
        @endphp
        @if($annoucement->datestart && $annoucement->dateend)
            @if($currentDate >= $annoucement->datestart && $currentDate <= $annoucement->dateend && $annoucement->status == '2')
                <div class="modal fade" id="autoPopupModal" tabindex="-1" aria-labelledby="autoPopupModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-body bgm">
                                <div class="float-right" style="padding-right: 15px; padding-top: 10px">
                                    <button type="button" class="close float-right" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="error-page">
                                    <h2 class="headline text-warning"> </h2>
                                    <div class="error-content" style="margin-left: 300px">
                                        <h2><i class="fas fa-exclamation-circle text-success"></i> Announcement!</h2>
                                        <h6 style="text-align: justify-all;">
                                            {{ $annoucement->announcement }}
                                        </h6>
                                        <form class="search-form" style="padding-top: 30px">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <input type="text" name="search" class="form-control" value="{{ date('F d, Y', strtotime($annoucement->datestart)) }}" disabled>
                                                </div>
                                                <div class="col-md-1" style="padding-top: 8px; text-align: center;">To</div>
                                                <div class="col-md-5">
                                                    <input type="text" name="search" class="form-control" value="{{ date('F d, Y', strtotime($annoucement->dateend)) }}" disabled>
                                                </div>
                                            </div>
                                        </form>
                                        <div id="countdown" class="col-md-12" style="padding-top: 20px; text-align: center; justify-content: center;">
                                            <div>Remaining Time:</div>
                                            <div class="row justify-content-center">
                                                <div class="countdown-container col-lg-2">
                                                    <div class="countdown-box" id="hoursBox">00</div>
                                                    <div class="countdown-label">Hr.</div>
                                                </div>
                                                <div class="countdown-container col-lg-2">
                                                    <div class="countdown-box" id="minutesBox">00</div>
                                                    <div class="countdown-label">Min.</div>
                                                </div>
                                                <div class="countdown-container col-lg-2">
                                                    <div class="countdown-box" id="secondsBox">00</div>
                                                    <div class="countdown-label">Seconds</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                @if(Auth::user()->role=='Administrator' || Auth::user()->role=='Budget Officer' || Auth::user()->role=='Procurement Officer' || Auth::user()->role=='Campus Admin' || Auth::user()->role=='Dean' || Auth::user()->role=='Office Head')
                    <div class="mt-5 col-lg-12">
                        @include('request.add.modal')
                        <div class="row">
                            @foreach($category as $data)
                                <div class="col-12 col-md-6 col-lg-4 mb-3">
                                    <div class="p-lg-7 rounded" style="background: url('{{ asset($data->bgimg) }}') no-repeat; background-size: cover;">
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
                                            <a href="#" class="btn btn-success shop-btn" data-toggle="modal" data-target="#modal-purpose" data-category-id="{{ $data->id }}">Shop Now</a>
                                        </div>
                                    </div>
                                </div>

                                @if($loop->iteration % 3 == 0 && !$loop->last)
                                    </div><div class="row">
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
            @endif
        @else

        @endif
    </div>
</div>
@endsection