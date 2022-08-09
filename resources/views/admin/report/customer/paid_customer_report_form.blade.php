@extends('layouts.admin')
@section('title')
    Paid Customer Report
@endsection
@section('content')
<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header all_and_all">
                    <h4 class="user-registration"><i class="mdi mdi-account-circle"></i> All Paid Customer Report</h4>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Customer Name</th> 
                                <th>Invoice No </th>
                                <th>Date</th>
                                <th>Due Amount</th> 
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($allData as $key => $item)
                                <tr>
                                    <td> {{ $key+1}} </td>
                                    <td> {{ $item['customer']['name'] }} </td> 
                                    <td> #{{ $item['invoice']['invoice_no'] }}   </td> 
                                    <td> {{  date('d-m-Y',strtotime($item['invoice']['date'])) }} </td> 
                                    <td> {{ $item->due_amount }} </td> 
                                    <td>
                                    <a href="{{ route('customer_invoice_details_report',$item->invoice_id) }}" target="_blank" class="btn btn-danger waves-effect waves-light"><i class="fa fa-print"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="row">
                        <div class="col-md-4 offset-md-3">
                            <div class="float-end d-print-none">
                                <a href="{{ route('all_paid_customer_report') }}" target="_blank" class="btn btn-success waves-effect waves-light"><i class="fa fa-print"></i></a>
                                <a href="#" class="btn btn-primary waves-effect waves-light ms-2">Download</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection