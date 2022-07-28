@extends('layouts.admin')
@section('title')
    Add Customer
@endsection
@section('content')
<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header all_and_all">
                    <h4 class="user-registration"><i class="mdi mdi-account-circle"></i> Add Customer Information </h4>
                    <a href="{{ route('all_customer') }}" class="all_link"><i class="mdi mdi-grid"></i> All Customer</a>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('insert_customer') }}" id="myForm" enctype="multipart/form-data" >
                        @csrf

                        <div class="row mb-3">
                            <label for="example-text-input" class="col-form-label">Customer Name </label>
                            <div class="form-group col-sm-12">
                                <input name="name" class="form-control" type="text"    >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-form-label">Customer Mobile </label>
                            <div class="form-group col-sm-12">
                                <input name="mobile_no" class="form-control" type="text"    >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-form-label">Customer Email </label>
                            <div class="form-group col-sm-12">
                                <input name="email" class="form-control" type="email"  >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-form-label">Customer Address </label>
                            <div class="form-group col-sm-12">
                                <input name="address" class="form-control" type="text"  >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-form-label">Customer Image </label>
                            <div class="form-group col-sm-12">
                                <input name="customer_image" class="form-control" type="file"  id="image">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-form-label">  </label>
                            <div class="col-sm-12">
                                <img id="showImage" class="rounded avatar-lg" src="{{  url('upload/no_image.jpg') }}" alt="Card image cap">
                            </div>
                        </div>
                        <input type="submit" class="btn btn-info waves-effect waves-light" value="Add Customer">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection