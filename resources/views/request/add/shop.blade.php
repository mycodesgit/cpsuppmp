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
                        @php
                            $currentDate = now()->format('Y-m-d');
                        @endphp
                        @if($annoucement->datestart && $annoucement->dateend)
                            @if($currentDate >= $annoucement->datestart && $currentDate <= $annoucement->dateend && $annoucement->status == '2')
                                <div class="modal fade" id="autoPopupModal" tabindex="-1" aria-labelledby="autoPopupModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-body bgmshop">
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
                        @else

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection