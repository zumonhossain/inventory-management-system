@extends('layouts.admin')
@section('title')
    Credit Customer
@endsection
@section('content')
<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header all_and_all">
                    <h4 class="user-registration"><i class="mdi mdi-account-circle"></i> All Credit Customer</h4>
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
                                        <a href="{{ route('edit_customer_invoice',$item->invoice_id) }}" class="btn btn-info sm" title="Edit Data">  <i class="fas fa-edit"></i> </a>
                                        <a href="{{ route('customer_invoice_details',$item->invoice_id) }}" class="btn btn-danger sm" title="Customer Invoice Details"> <i class="fa fa-eye"></i> </a>
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