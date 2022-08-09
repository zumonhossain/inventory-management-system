@extends('layouts.admin')
@section('title')
    Edit Invoice
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header all_and_all">
                    <h4 class="user-registration"><i class="mdi mdi-account-circle"></i> Update Customer Invoice </h4>
                    <a href="{{ route('credit_customer') }}" class="all_link"><i class="mdi mdi-grid"></i> All Credit Customer</a>
                </div>
                <div class="card-body">

                    <!-- Customer Information -->
                    <div class="row">
                        <div class="col-12">
                            <div>
                                <div class="p-2">
                                    <h3 class="font-size-16"><strong>Customer Invoice No: #{{ $payment['invoice']['invoice_no'] }} </strong></h3>
                                </div>
                                <div class="">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <td><strong>Customer Name </strong></td>
                                                    <td class="text-center"><strong>Customer Mobile</strong></td>
                                                    <td class="text-center"><strong>Address</strong></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td> {{ $payment['customer']['name'] }}</td>
                                                    <td class="text-center">{{ $payment['customer']['mobile_no']  }}</td>
                                                    <td class="text-center">{{ $payment['customer']['email']  }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end row -->



                    <div class="row">
                        <div class="col-12">
                            <form method="post" action="{{ route('customer_update_invoice',$payment->invoice_id)}}" id="myForm">
                                @csrf     

                                <div>
                                    <div class="p-2"></div>
                                    <div class="">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <td><strong>Sl </strong></td>
                                                        <td class="text-center"><strong>Category</strong></td>
                                                        <td class="text-center"><strong>Product Name</strong></td>
                                                        <td class="text-center"><strong>Current Stock</strong></td>
                                                        <td class="text-center"><strong>Quantity</strong></td>
                                                        <td class="text-center"><strong>Unit Price </strong></td>
                                                        <td class="text-center"><strong>Total Price</strong></td>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @php
                                                        $total_sum = '0';
                                                    @endphp

                                                    @foreach($invoice_details as $key => $details)
                                                        <tr>
                                                            <td class="text-center">{{ $key+1 }}</td>
                                                            <td class="text-center">{{ $details['category']['name'] }}</td>
                                                            <td class="text-center">{{ $details['product']['name'] }}</td>
                                                            <td class="text-center">{{ $details['product']['quantity'] }}</td>
                                                            <td class="text-center">{{ $details->selling_qty }}</td>
                                                            <td class="text-center">{{ $details->unit_price }}</td>
                                                            <td class="text-center">{{ $details->selling_price }}</td>
                                                        </tr>
                                                        @php
                                                            $total_sum += $details->selling_price;
                                                        @endphp

                                                    @endforeach
                                                    <tr>
                                                        <td class="thick-line"></td>
                                                        <td class="thick-line"></td>
                                                        <td class="thick-line"></td>
                                                        <td class="thick-line"></td>
                                                        <td class="thick-line"></td>
                                                        <td class="thick-line text-center"><strong>Subtotal</strong></td>
                                                        <td class="thick-line text-end">${{ $total_sum }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="no-line"></td>
                                                        <td class="no-line"></td>
                                                        <td class="no-line"></td>
                                                        <td class="no-line"></td>
                                                        <td class="no-line"></td>
                                                        <td class="no-line text-center"><strong>Discount Amount</strong></td>
                                                        <td class="no-line text-end">${{ $payment->discount_amount }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="no-line"></td>
                                                        <td class="no-line"></td>
                                                        <td class="no-line"></td>
                                                        <td class="no-line"></td>
                                                        <td class="no-line"></td>
                                                        <td class="no-line text-center"><strong>Paid Amount</strong></td>
                                                        <td class="no-line text-end">${{ $payment->paid_amount }}</td>
                                                    </tr>

                                                    <tr>
                                                        <td class="no-line"></td>
                                                        <td class="no-line"></td>
                                                        <td class="no-line"></td>
                                                        <td class="no-line"></td>
                                                        <td class="no-line"></td>
                                                        <td class="no-line text-center"><strong>Due Amount</strong></td>

                                                        <input type="hidden" name="new_paid_amount" value="{{$payment->due_amount}}">

                                                        <td class="no-line text-end">${{ $payment->due_amount }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="no-line"></td>
                                                        <td class="no-line"></td>
                                                        <td class="no-line"></td>
                                                        <td class="no-line"></td>
                                                        <td class="no-line"></td>
                                                        <td class="no-line text-center"><strong>Grand Amount</strong></td>
                                                        <td class="no-line text-end"><h4 class="m-0">${{ $payment->total_amount }}</h4></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-md-3">
                                                <label> Paid Status </label>
                                                    <select name="paid_status" id="paid_status" class="form-select">
                                                        <option value="">Select Status </option>
                                                        <option value="full_paid">Full Paid </option> 
                                                        <option value="partial_paid">Partial Paid </option>
                                                    </select>
                                                    <input type="text" name="paid_amount" class="form-control paid_amount" placeholder="Enter Paid Amount" style="display:none;">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <div class="md-3">
                                                    <label for="example-text-input" class="form-label">Date</label>
                                                    <input class="form-control example-date-input" placeholder="YYYY-MM-DD"  name="date" type="date"  id="date" value="{{ date('Y-m-d') }}">
                                                </div>
                                            </div>

                                            <div class="form-group col-md-12">
                                                <div class="md-3" style="padding-top: 30px;">
                                                <button type="submit" class="btn btn-info">Invoice Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div> 
                    </div> <!-- end row -->

                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('contents/admin') }}/assets/libs/jquery/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).on('change','#paid_status', function(){
            var paid_status = $(this).val();
            if (paid_status == 'partial_paid') {
                $('.paid_amount').show();
            }else{
                $('.paid_amount').hide();
            }
        }); 
    </script>

    <script type="text/javascript">
        $(document).ready(function (){
            $('#myForm').validate({
                rules: {
                    paid_status: {
                        required : true,
                    }, 
                    date: {
                        required : true,
                    },
                },
                messages :{
                    paid_status: {
                        required : 'Please Enter Paid Status',
                    },
                    date: {
                        required : 'Please Enter Date',
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