@extends('layouts.admin')
@section('title')
    Edit Category
@endsection
@section('content')
    <script src="{{ asset('contents/admin') }}/assets/libs/jquery/jquery.min.js"></script>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header all_and_all">
                    <h4 class="user-registration"><i class="mdi mdi-account-circle"></i> Update Category Information </h4>
                    <a href="{{ route('all_category') }}" class="all_link"><i class="mdi mdi-grid"></i> All Category</a>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('update_category') }}" id="myForm" >
                        @csrf

                        <input type="hidden" name="id" value="{{ $category->category_id }}">

                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Category Name </label>
                            <div class="form-group col-sm-10">
                                <input name="name" class="form-control" value="{{ $category->name }}" type="text"    >
                            </div>
                        </div>
                        <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Category">
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
                    
                },
                messages :{
                    name: {
                        required : 'Please Enter Your Name',
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