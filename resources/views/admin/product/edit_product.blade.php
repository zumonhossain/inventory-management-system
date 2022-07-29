@extends('layouts.admin')
@section('title')
    Edit Product
@endsection
@section('content')
    <script src="{{ asset('contents/admin') }}/assets/libs/jquery/jquery.min.js"></script>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header all_and_all">
                    <h4 class="user-registration"><i class="mdi mdi-account-circle"></i> Update Product Information </h4>
                    <a href="{{ route('all_product') }}" class="all_link"><i class="mdi mdi-grid"></i> All Product</a>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('update_product') }}" id="myForm" >
                        @csrf

                        <input type="hidden" name="id" value="{{ $product->product_id }}">

                        <div class="row mb-3">
                            <label for="example-text-input" class="col-form-label">Product Name </label>
                            <div class="form-group col-sm-12">
                                <input name="name" value="{{ $product->name }}" class="form-control" type="text"    >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-form-label">Supplier Name </label>
                            <div class="col-sm-12">
                                <select name="supplier_id" class="form-select" aria-label="Default select example">
                                    <option selected="">Open this select menu</option>
                                    @foreach($suppliers as $item)
                                        <option value="{{ $item->supplier_id }}" {{ $item->supplier_id == $product->supplier_id ? 'selected' : '' }}   >{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-form-label">Unit Name </label>
                            <div class="col-sm-12">
                                <select name="unit_id" class="form-select" aria-label="Default select example">
                                    <option selected="">Open this select menu</option>
                                    @foreach($units as $item)
                                        <option value="{{ $item->unit_id }}" {{ $item->unit_id == $product->unit_id ? 'selected' : '' }} >{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-form-label">Category Name </label>
                            <div class="col-sm-12">
                                <select name="category_id" class="form-select" aria-label="Default select example">
                                    <option selected="">Open this select menu</option>
                                    @foreach($categories as $item)
                                        <option value="{{ $item->category_id }}" {{ $item->category_id == $product->category_id ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Product">
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
                    supplier_id: {
                        required : true,
                    },
                    unit_id: {
                        required : true,
                    },
                    category_id: {
                        required : true,
                    },
                },
                messages :{
                    name: {
                        required : 'Please Enter Your Product Name',
                    },
                    supplier_id: {
                        required : 'Please Select One Supplier',
                    },
                    unit_id: {
                        required : 'Please Select One Unit',
                    },
                    category_id: {
                        required : 'Please Select One Category',
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