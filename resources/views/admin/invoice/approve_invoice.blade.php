@extends('layouts.admin')
@section('title')
    Approve Invoice
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header all_and_all">
                    <h4 class="user-registration"><i class="mdi mdi-account-circle"></i> Approve Invoice </h4>
                    <a href="{{ route('pending_invoice') }}" class="all_link"><i class="mdi mdi-grid"></i> All Pending Invoice</a>
                </div>
                <div class="card-header">
                    <span><strong>Invoice NO :</strong> #{{ $invoice->invoice_no }}</span>
                    <span style="float:right"><strong>Date :</strong> {{ $invoice->date }}</span>
                </div>
                <div class="card-body">

                    <table id="datatable" class="table bg-warning table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <tbody>
                            <tr>
                                <td colspan="4">
                                    <p style="color:black;font-weight: bold;font-size:20px;text-align:center;margin:0;text-transform:uppercase"> Customer Information </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p> <strong> Name : </strong> <br> {{ $payment['customer']['name']  }} </p>
                                </td>
                                <td>
                                    <p> <strong> Mobile : </strong> <br>  {{ $payment['customer']['mobile_no']  }} </p>
                                </td>
                                <td>
                                    <p> <strong> Email : </strong> <br>  {{ $payment['customer']['email']  }} </p>
                                </td>                
                            </tr>

                            <tr>
                                <td colspan="4">
                                    <p> <strong> Description : </strong> {{ $invoice->description  }} </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <form method="post" action="{{ route('insert_approve_invoice',$invoice->id) }}">
                        @csrf

                        <table id="datatable" class="table bg-warning table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th class="text-center">Sl</th>
                                    <th class="text-center">Category</th>
                                    <th class="text-center">Product Name</th>
                                    <th class="text-center bg-success">Current Stock</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-center">Unit Price </th>
                                    <th class="text-center">Total Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total_sum = '0';
                                @endphp

                                @foreach($invoice['invoice_details'] as $key => $item)
                                    <tr>
                                        <input type="hidden" name="category_id[]" value="{{ $item->category_id }}">
                                        <input type="hidden" name="product_id[]" value="{{ $item->product_id }}">
                                        <input type="hidden" name="selling_qty[{{$item->id}}]" value="{{ $item->selling_qty }}">

                                        <td class="text-center">{{ $key+1 }}</td>
                                        <td class="text-center">{{ $item['category']['name'] }}</td>
                                        <td class="text-center">{{ $item['product']['name'] }}</td>
                                        <td class="text-center bg-success">{{ $item['product']['quantity'] }}</td>
                                        <td class="text-center">{{ $item->selling_qty }}</td>
                                        <td class="text-center">{{ $item->unit_price }}</td>
                                        <td class="text-center">{{ $item->selling_price }}</td>
                                    </tr>
                                    
                                    @php
                                        $total_sum += $item->selling_price;
                                    @endphp

                                @endforeach

                                <tr>
                                    <td colspan="6"> <strong>Sub Total</strong> </td>
                                    <td> {{ $total_sum }} </td>
                                </tr>
                                <tr>
                                    <td colspan="6"> <strong>Discount</strong> </td>
                                    <td> {{ $payment->discount_amount }} </td>
                                </tr>
                                <tr>
                                    <td colspan="6"> <strong>Paid Amount</strong> </td>
                                    <td>{{ $payment->paid_amount }} </td>
                                </tr>
                                <tr>
                                    <td colspan="6"> <strong>Due Amount</strong> </td>
                                    <td> {{ $payment->due_amount }} </td>
                                </tr>
                                <tr>
                                    <td colspan="6"> <strong>Grand Amount</strong></td>
                                    <td>{{ $payment->total_amount }}</td>
                                </tr>
                            </tbody>   
                        </table>
                        <button type="submit" class="btn btn-info">Invoice Approve </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection