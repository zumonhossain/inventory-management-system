@extends('layouts.admin')
@section('title')
    Edit Supplier
@endsection
@section('content')
    <script src="{{ asset('contents/admin') }}/assets/libs/jquery/jquery.min.js"></script>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header all_and_all">
                    <h4 class="user-registration"><i class="mdi mdi-account-circle"></i> Update Supplier Information </h4>
                    <a href="{{ route('all_supplier') }}" class="all_link"><i class="mdi mdi-grid"></i> All Supplier</a>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('supplier_update_form') }}" id="myForm" >
                        @csrf

                        <input type="hidden" name="id" value="{{ $supplier->id }}">

                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Supplier Name </label>
                            <div class="form-group col-sm-10">
                                <input name="name" class="form-control" value="{{ $supplier->name }}" type="text"    >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Supplier Mobile </label>
                            <div class="form-group col-sm-10">
                                <input name="mobile_no" value="{{ $supplier->mobile_no }}" class="form-control" type="text"    >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Supplier Email </label>
                            <div class="form-group col-sm-10">
                                <input name="email" value="{{ $supplier->email }}" class="form-control" type="email"  >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Supplier Address </label>
                            <div class="form-group col-sm-10">
                                <input name="address" value="{{ $supplier->address }}" class="form-control" type="text"  >
                            </div>
                        </div>
                        <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Supplier">
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