@extends('layouts.admin')
@section('title')
    Add Unit
@endsection
@section('content')
    <script src="{{ asset('contents/admin') }}/assets/libs/jquery/jquery.min.js"></script>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header all_and_all">
                    <h4 class="user-registration"><i class="mdi mdi-account-circle"></i> Add Unit Information </h4>
                    <a href="{{ route('all_unit') }}" class="all_link"><i class="mdi mdi-grid"></i> All Unit</a>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('insert_unit') }}" id="myForm" >
                    @csrf
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-form-label">Unit Name </label>
                            <div class="form-group col-sm-12">
                                <input name="name" class="form-control" type="text"    >
                            </div>
                        </div>
                        <input type="submit" class="btn btn-info waves-effect waves-light" value="Add unit">
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
                    }
                },
                messages :{
                    name: {
                        required : 'Please Enter Your Name',
                    }
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