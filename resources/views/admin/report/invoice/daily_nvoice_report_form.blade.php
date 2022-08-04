@extends('layouts.admin')
@section('title')
    Daily Invoice Report Form
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header all_and_all">
                    <h4 class="user-registration"><i class="mdi mdi-account-circle"></i> Daily Invoice Report </h4>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('daily_invoice_report') }}" target="_blank" id="myForm">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="md-3 form-group">
                                    <label for="example-text-input" class="form-label">Start Date</label>
                                    <input class="form-control example-date-input" name="start_date" type="date"  id="start_date" placeholder="YY-MM-DD">
                                </div>
                            </div>

                            
                            <div class="col-md-4">
                                <div class="md-3 form-group">
                                    <label for="example-text-input" class="form-label">End Date</label>
                                    <input class="form-control example-date-input" name="end_date" type="date"  id="end_date" placeholder="YY-MM-DD">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="md-3">
                                    <label for="example-text-input" class="form-label" style="margin-top:43px;"> </label>
                                <button type="submit" class="btn btn-info">Search</button>
                                </div>
                            </div>
                        </div> <!-- // end row  --> 
                    </form>
                </div> <!-- End card-body -->
            </div>
        </div> <!-- end col -->
    </div>


    <script src="{{ asset('contents/admin') }}/assets/libs/jquery/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function (){
            $('#myForm').validate({
                rules: {
                    start_date: {
                        required : true,
                    }, 
                    end_date: {
                        required : true,
                    },
                    
                },
                messages :{
                    start_date: {
                        required : 'Please Select Start Date',
                    },
                    end_date: {
                        required : 'Please Select End Date',
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