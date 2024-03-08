@extends('layouts.master')

@section('body')
<div class="container-fluid">
    <div class="row" style="padding-top: 100px;">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-user">
                            <i class="fas fa-user-plus"></i> Add New
                        </button>
                    </h3>
                </div>
                @include('users.modal')
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Campus</th>
                                    <th>Office</th>
                                    <th>Last Name</th>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                @php $no = 1; @endphp
                                @foreach($user as $data)
                                <tr id="tr-{{ $data->uid }}">
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data->campus_name }}</td>
                                    <td>{{ $data->office_abbr }}</td>
                                    <td>{{ $data->lname }}</td>
                                    <td>{{ $data->fname }}</td>
                                    <td>{{ $data->mname }}</td>
                                    <td>{{ $data->username }}</td>
                                    <td>{{ $data->role }}</td>
                                    <td>
                                        <a href="{{ route('userEdit', ['id' => $data->id]) }}" class="btn btn-info btn-xs btn-edit">
                                            <i class="fas fa-exclamation-circle"></i>
                                        </a>
                                        <button value="{{ $data->uid }}" class="btn btn-danger btn-xs users-delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
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