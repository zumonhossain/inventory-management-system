@extends('layouts.admin')
@section('title')
    Edit Customer
@endsection
@section('content')
    <script src="{{ asset('contents/admin') }}/assets/libs/jquery/jquery.min.js"></script>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header all_and_all">
                    <h4 class="user-registration"><i class="mdi mdi-account-circle"></i> Update Customer Information </h4>
                    <a href="{{ route('all_customer') }}" class="all_link"><i class="mdi mdi-grid"></i> All Customer</a>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('update_customer') }}" id="myForm" enctype="multipart/form-data" >
                        @csrf

                        <input type="hidden" name="id" value="{{ $customer->id }}">

                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Customer Name </label>
                            <div class="form-group col-sm-10">
                                <input name="name" value="{{ $customer->name }}" class="form-control" type="text"    >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Customer Mobile </label>
                            <div class="form-group col-sm-10">
                                <input name="mobile_no"  value="{{ $customer->mobile_no }}" class="form-control" type="text"    >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Customer Email </label>
                            <div class="form-group col-sm-10">
                                <input name="email"  value="{{ $customer->email }}" class="form-control" type="email"  >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Customer Address </label>
                            <div class="form-group col-sm-10">
                                <input name="address" value="{{ $customer->address }}" class="form-control" type="text"  >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Customer Image </label>
                            <div class="form-group col-sm-10">
                                <input name="customer_image" class="form-control" type="file"  id="image">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">  </label>
                            <div class="col-sm-10">
                                <img id="showImage" class="rounded avatar-lg" src="{{ asset($customer->customer_image) }}" alt="Card image cap">
                            </div>
                        </div>
                        <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Customer">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function (){
            $('#myForm').validate({
                rules: {
                    name: {
                        required : true,
                    }, 
                    mobile_no: {
                        required : true,
                    },
                    email: {
                        required : true,
                    },
                    address: {
                        required : true,
                    },
                    customer_image: {
                        required : true,
                    },
                },
                messages :{
                    name: {
                        required : 'Please Enter Your Name',
                    },
                    mobile_no: {
                        required : 'Please Enter Your Mobile Number',
                    },
                    email: {
                        required : 'Please Enter Your Email',
                    },
                    address: {
                        required : 'Please Enter Your Address',
                    },
                    customer_image: {
                        required : 'Please Select one Image',
                    },
                },
                errorElement : 'span', 
                errorPlacement: function (error,element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight : function(element, errorClass, validClass){
                    $(element).addClass('is-invalid');
                },
                unhighlight : function(element, errorClass, validClass){
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>
@endsection