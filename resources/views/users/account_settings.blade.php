@extends('layouts.master')

@section('body')
<div class="container-fluid">
    <div class="row" style="padding-top: 100px;">
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle"
                        src="{{ asset('template/img/user.png') }}"
                        alt="User profile picture">
                    </div>
                    <h3 class="profile-username text-center">{{Auth::user()->fname}}</h3>
                    <a href="#" class="btn btn-default btn-block btn-muted" ><b>{{Auth::user()->role}}</b></a>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="card">
                <div class="card-body">
                    <form class="form-horizontal" method="post" id="addEmp">

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-4">
                                    <label for="exampleInputName">First Name:</label>
                                    <input type="text" name="fname" oninput="this.value = this.value.toUpperCase()" placeholder="Enter First Name" value="{{Auth::user()->fname}}" class="form-control">
                                </div>

                                <div class="col-md-4">
                                    <label for="exampleInputName">Middle Name:</label>
                                    <input type="text" name="mname" oninput="this.value = this.value.toUpperCase()" placeholder="Enter Middle Name" value="{{Auth::user()->mname}}" class="form-control">
                                </div>

                                <div class="col-md-4">
                                    <label for="exampleInputName">Last Name:</label>
                                    <input type="text" name="lname" oninput="this.value = this.value.toUpperCase()" placeholder="Enter Last Name" value="{{Auth::user()->lname}}" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-4">
                                    <label for="exampleInputName">Username:</label>
                                    <input type="text" name="username" placeholder="Enter Username" value="{{Auth::user()->username}}" class="form-control">
                                </div>

                                <div class="col-md-4">
                                    <label for="exampleInputName">Gender:</label>
                                    <select name="emp_gender" class="form-control">
                                        <option value=""> --- Select --- </option>
                                        <option value="Male" {{Auth::user()->gender == 'Male' ? 'selected="selected"' : '' }}>Male</option>
                                        <option value="Female" {{Auth::user()->gender == 'Female' ? 'selected="selected"' : '' }}>Female</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="exampleInputName">Usertype:</label>
                                    <select name="usertype" class="form-control">
                                        <option value=""> --- Select --- </option>
                                        <option value="Administrator" {{Auth::user()->role == 'Administrator' ? 'selected="selected"' : '' }}>Administrator</option>
                                        <option value="Procurement Officer" {{Auth::user()->role == 'Procurement Officer' ? 'selected="selected"' : '' }}>Procurement Officer</option>
                                        <option value="Staff" {{Auth::user()->role == 'Staff' ? 'selected="selected"' : '' }}>Staff</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <a href="" class="btn btn-success">
                                        <i class="fas fa-save"></i> Update
                                    </a>
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