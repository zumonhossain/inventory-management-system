@extends('layouts.admin')
@section('title')
    Customer Wise Report
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header all_and_all">
                    <h4 class="user-registration"><i class="mdi mdi-account-circle"></i>Customer Wise Report</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <strong> Customer Wise Credit Report </strong>
                            <input type="radio" name="customer_wise_report" value="customer_wise_credit" class="search_value"> &nbsp;&nbsp;
                            <strong> Customer Wise Paid Report </strong>
                            <input type="radio" name="customer_wise_report" value="customer_wise_paid" class="search_value">
                        </div>        
                    </div> 

                    <div class="show_credit" style="display:none">
                        <form method="GET" action="{{ route('customer_wise_credit_report') }}" id="myForm" target="_blank" >

                            <div class="row">
                                <div class="col-sm-8 form-group">
                                <label>Customer Name </label>
                                <select name="customer_id" class="form-select select2"  >
                                    <option value="">Select Customer</option>
                                    @foreach($customers as $cus)
                                        <option value="{{ $cus->id }}">{{ $cus->name }}</option>
                                    @endforeach
                                </select>                    
                                </div>

                                <div class="col-sm-4" style="padding-top: 28px;">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="show_paid" style="display:none">
                        <form method="GET" action="{{ route('customer_wise_paid_report') }}" id="myForm" target="_blank" >
                            <div class="row">
                                <div class="col-sm-8 form-group">
                                <label>Customer Name </label>
                                <select name="customer_id" class="form-select select2"  >
                                    <option value="">Select Customer</option>
                                    @foreach($customers as $cus)
                                        <option value="{{ $cus->id }}">{{ $cus->name }}</option>
                                    @endforeach
                                </select>                    
                                </div>

                                <div class="col-sm-4" style="padding-top: 28px;">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('contents/admin') }}/assets/libs/jquery/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).on('change','.search_value', function(){
            var search_value = $(this).val();
            if (search_value == 'customer_wise_credit') {
                $('.show_credit').show();
            }else{
                $('.show_credit').hide();
            }
        }); 
    </script>


    <script type="text/javascript">
        $(document).on('change','.search_value', function(){
            var search_value = $(this).val();
            if (search_value == 'customer_wise_paid') {
                $('.show_paid').show();
            }else{
                $('.show_paid').hide();
            }
        }); 
    </script>
@endsection