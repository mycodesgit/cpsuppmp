@extends('layouts.master')

@section('body')
<div class="container-fluid">
    <div class="row" style="padding-top: 100px;">
        <div class="col-lg-9">
            <div class="card">
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
                                @foreach($user as $user)
                                <tr id="tr-{{ $user->uid }}">
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $user->campus_name }}</td>
                                    <td>{{ $user->office_abbr }}</td>
                                    <td>{{ $user->lname }}</td>
                                    <td>{{ $user->fname }}</td>
                                    <td>{{ $user->mname }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td>
                                        <button value="{{ $user->uid }}" class="btn btn-info btn-xs users-edit">
                                            <i class="fas fa-exclamation-circle"></i>
                                        </button>
                                        <button value="{{ $user->uid }}" class="btn btn-danger btn-xs users-delete">
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
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-plus"></i> Add
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('userCreate') }}" class="form-horizontal add-form-user" method="POST">
                        @csrf
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label for="exampleInputName">Last Name:</label>
                                    <input type="text" name="lname" oninput="this.value = this.value.toUpperCase()" placeholder="Enter Last Name" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label for="exampleInputName">First Name:</label>
                                    <input type="text" name="fname" oninput="this.value = this.value.toUpperCase()" placeholder="Enter First Name" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label for="exampleInputName">Middle Name:</label>
                                    <input type="text" name="mname" oninput="this.value = this.value.toUpperCase()" placeholder="Enter Middle Name" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label for="exampleInputName">Username:</label>
                                    <input type="text" name="username" placeholder="Enter Username" class="form-control">   
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label for="exampleInputName">Password:</label>
                                    <input type="password" name="password" placeholder="Enter Password" class="form-control"> 
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label for="exampleInputName">Gender:</label>
                                    <select class="form-control" name="gender">
                                        <option disabled selected> --- Select --- </option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label for="exampleInputName">Campus:</label>
                                    <select class="form-control select2bs4" name="campus_id">
                                        <option disabled selected> --- Select --- </option>
                                        @foreach ($camp as $cp)
                                            <option value="{{ $cp->id }}">{{ $cp->campus_name }}</option>
                                        @endforeach
                                    </select>
                               </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label for="exampleInputName">Office:</label>
                                    <select class="form-control select2bs4" name="office_id">
                                        <option disabled selected> --- Select --- </option>
                                        @foreach ($off as $data)
                                            <option value="{{ $data->id }}">{{ $data->office_name }}</option>
                                        @endforeach
                                    </select>
                               </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label for="exampleInputName">Role:</label>
                                    <select class="form-control" name="role">
                                        <option value=""> --- Select Role --- </option>
                                        <option value="Administrator">Administrator</option>
                                        <option value="Budget Officer">Budget Officer</option>
                                        <option value="Procurement Officer">Procurement Officer</option>
                                        <option value="Campus Admin">Campus Admin</option>
                                        <option value="Dean">Dean</option>
                                        <option value="Office Head">Office Head</option>
                                    </select>
                                </div>
                            </div>
                        </div> 
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                                        Close
                                    </button>
                                    <button type="submit" class="btn btn-primary">
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