@extends('layouts.admin')
@section('title')
    Report Invoice List
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header all_and_all">
                    <h4 class="user-registration"><i class="mdi mdi-account-circle"></i> Report Invoice Information </h4>
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
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($invoice as $key => $item)
                                <tr>
                                    <td> {{ $key+1}} </td>
                                    <td> {{ $item['payment']['customer']['name'] }} </td> 
                                    <td> #{{ $item->invoice_no }} </td> 
                                    <td> {{ date('d-m-Y',strtotime($item->date)) }} </td> 
                                    <td> {{ $item->description }} </td>
                                    <td> $ {{ $item->payment->total_amount }} </td>
                                    <!-- <td>  $ {{ $item['payment']['total_amount'] }} </td> -->
                                    <td>
                                        <a href="{{ route('report_invoice',$item->id) }}" target="_blank" class="btn btn-danger sm" title="Print Invoice"><i class="fa fa-print"></i> </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection