@extends('layouts.admin')
@section('title')
    All Invoice
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header all_and_all">
                    <h4 class="user-registration"><i class="mdi mdi-account-circle"></i> All Invoice Information </h4>
                    <a href="{{ route('add_invoice') }}" class="all_link"><i class="mdi mdi-grid"></i> Add Invoice</a>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Customer Name</th> 
                                <th>Invoice No </th>
                                <th>Date </th>
                                <th>Desctipion</th>  
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($invoice as $key => $item)
                                <tr>
                                    <td> {{ $key+1}} </td>
                                    <td> {{ $item->payment->customer_id }}</td> 
                                    <td> #{{ $item->invoice_no }} </td> 
                                    <td> {{ date('d-m-Y',strtotime($item->date))  }} </td> 
                                    
                                    
                                    <td>  {{ $item->description }} </td> 

                                    <td>  $ {{ $item->payment->total_amount }} </td>
                                    <!-- <td>  $ {{ $item['payment']['total_amount'] }} </td> -->
                                
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection