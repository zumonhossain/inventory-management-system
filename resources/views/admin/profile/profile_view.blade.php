@extends('layouts.admin')
@section('title')
    Admin Profile
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Admin Profile</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="card"><br><br>
                <center>
                    <img class="rounded-circle avatar-xl" src="{{ (!empty($adminData->profile_image))? url('upload/admin_images/'.$adminData->profile_image):url('upload/no_image.jpg') }}" alt="profile-img">
                </center>
                <div class="card-body">
                    <h4 class="card-title"><b>Name :</b> {{ $adminData->name }} </h4>
                    <hr>
                    <h4 class="card-title"><b>Email :</b> {{ $adminData->email }} </h4>
                    <hr>
                    <h4 class="card-title"><b>Username :</b> {{ $adminData->username }} </h4>
                    <hr>
                    <a href="{{ route('edit.profile') }}" class="btn btn-info btn-rounded waves-effect waves-light" > Edit Profile</a>
                </div>
            </div>
        </div>
    </div> 
@endsection