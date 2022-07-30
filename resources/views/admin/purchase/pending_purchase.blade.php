@extends('layouts.admin')
@section('title')
    All Pending Purchase
@endsection
@section('content')
<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header all_and_all">
                    <h4 class="user-registration"><i class="mdi mdi-account-circle"></i> All Pending Purchase Information </h4>
                    <a href="{{ route('add_purchase') }}" class="all_link"><i class="mdi mdi-grid"></i> Add Purchase</a>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Purhase No</th> 
                                <th>Date </th>
                                <th>Supplier</th>
                                <th>Category</th> 
                                <th>Qty</th> 
                                <th>Product Name</th> 
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        	@foreach($purchases as $key => $item)
                                <tr>
                                    <td> {{ $key+1}} </td>
                                    <td> {{ $item->purchase_no }} </td> 
                                    <td> {{ date('d-m-Y',strtotime($item->date))  }} </td> 
                                    <td> {{ $item->supplier->name }} </td> 
                                    <td> {{ $item->category->name }} </td> 
                                    <td> {{ $item->buying_qty }} </td> 
                                    <td> {{ $item->product->name }} </td>
                                    <td> 
                                        @if($item->purchase_status == '0')
                                            <span class="btn btn-warning">Pending</span>
                                        @elseif($item->purchase_status == '1')
                                            <span class="btn btn-success">Approved</span>
                                        @endif
                                    </td>
                                    <td> 
                                        @if($item->purchase_status == '0')
                                        <a href="{{ route('approve_purchase',$item->purchase_id) }}" class="btn btn-danger sm" title="Approved" id="approveBtn">  <i class="fas fa-check-circle"></i> </a>
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