@extends('layouts.admin')
@section('title')
    All Pending
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header all_and_all">
                    <h4 class="user-registration"><i class="mdi mdi-account-circle"></i> All Pending Invoice Information </h4>
                    <a href="{{ route('all_invoice') }}" class="all_link"><i class="mdi mdi-grid"></i> All Approved</a>
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
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($invoice as $key => $item)
                                <tr>
                                    <td> {{ $key+1}} </td>
                                    <td> {{ $item['payment']['customer']['name'] }}</td> 
                                    <td> #{{ $item->invoice_no }} </td> 
                                    <td> {{ date('d-m-Y',strtotime($item->date))  }} </td> 
                                    
                                    
                                    <td>  {{ $item->description }} </td> 

                                    <td>  $ {{ $item->payment->total_amount }} </td>
                                    <!-- <td>  $ {{ $item['payment']['total_amount'] }} </td> -->
                                
                                    <td> 
                                        @if($item->invoice_status == '0')
                                            <span class="btn btn-warning">Pending</span>
                                        @elseif($item->invoice_status == '1')
                                            <span class="btn btn-success">Approved</span>
                                        @endif
                                    </td> 
                                    <td> 
                                        @if($item->invoice_status == '0')
                                            <a href="#" class="btn btn-dark sm" title="Approved" id="approveBtn">  <i class="fas fa-check-circle"></i> </a>
                                            <a href="{{ route('delete_invoice',$item->id) }}" class="btn btn-danger sm" title="Delete Data" id="delete">  <i class="fas fa-trash-alt"></i> </a>
                                        @endif
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