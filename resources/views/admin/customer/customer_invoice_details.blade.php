@extends('layouts.admin')
@section('title')
    Customer Invoice Details
@endsection
@section('content')
<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header all_and_all">
                    <h4 class="user-registration"><i class="mdi mdi-account-circle"></i>Customer Invoice Details</h4>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-6 mt-4">
                                    <h4 class="font-size-16 m-0"><strong>Invoice No # {{ $payment['invoice']['invoice_no'] }}</strong></h4>
                                </div>
                                <div class="col-6 mt-4 text-end">
                                    <address>
                                        <strong>Invoice Date:</strong><br>
                                        {{ date('d-m-Y',strtotime($payment['invoice']['date'])) }} <br><br>
                                    </address>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div>
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
                                                    $invoice_details = App\Models\InvoiceDetail::where('invoice_id',$payment->invoice_id)->get();     
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
                                                <tr>
                                                    <td colspan="7" style="text-align: center;font-weight: bold;">Paid Summary</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" style="text-align: center;font-weight: bold;">Date </td>
                                                    <td colspan="3" style="text-align: center;font-weight: bold;">Amount</td>
                                                </tr>

                                                @php
                                                    $payment_details = App\Models\PaymentDetail::where('invoice_id',$payment->invoice_id)->get();
                                                @endphp

                                                @foreach($payment_details as $item)
                                                    <tr>
                                                        <td colspan="4" style="text-align: center;font-weight: bold;">{{ date('d-m-Y',strtotime($item->date)) }}</td>
                                                        <td colspan="3" style="text-align: center;font-weight: bold;">{{ $item->current_paid_amount }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end row -->

                </div>
            </div>
        </div>
    </div>
@endsection