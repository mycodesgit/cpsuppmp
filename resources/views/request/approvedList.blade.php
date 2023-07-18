@extends('layouts.master')

@section('body')
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
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Cateogry</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>ICT Equipment</td>
                                    <td>
                                        <button value="" class="btn btn-info btn-xs users-edit">
                                            <i class="fas fa-exclamation-circle"></i>
                                        </button>
                                        <button value="" class="btn btn-danger btn-xs users-delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>ICT Equipment</td>
                                    <td>
                                        <button value="" class="btn btn-info btn-xs users-edit">
                                            <i class="fas fa-exclamation-circle"></i>
                                        </button>
                                        <button value="" class="btn btn-danger btn-xs users-delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>ICT Equipment</td>
                                    <td>
                                        <button value="" class="btn btn-info btn-xs users-edit">
                                            <i class="fas fa-exclamation-circle"></i>
                                        </button>
                                        <button value="" class="btn btn-danger btn-xs users-delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>ICT Equipment</td>
                                    <td>
                                        <button value="" class="btn btn-info btn-xs users-edit">
                                            <i class="fas fa-exclamation-circle"></i>
                                        </button>
                                        <button value="" class="btn btn-danger btn-xs users-delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>ICT Equipment</td>
                                    <td>
                                        <button value="" class="btn btn-info btn-xs users-edit">
                                            <i class="fas fa-exclamation-circle"></i>
                                        </button>
                                        <button value="" class="btn btn-danger btn-xs users-delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection