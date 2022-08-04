@extends('layouts.admin')
@section('title')
    Stock Report
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header all_and_all">
                    <h4 class="user-registration"><i class="mdi mdi-account-circle"></i> Stock Report </h4>
                    <a href="{{ route('stock_report') }}" target="_blank" class="btn btn-danger sm" style="float:right"><i class="fa fa-print"></i></a>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Supplier Name</th>
                                <th>Unit</th>
                                <th>Category</th> 
                                <th>Product Name</th> 
                                <th>In Qty</th> 
                                <th>Out Qty </th>  
                                <th>Stock </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($allData as $key => $item)

                                @php
                                    $buying_total = App\Models\Purchase::where('category_id',$item->category_id)->where('product_id',$item->id)->where('purchase_status','1')->sum('buying_qty');

                                    $selling_total = App\Models\InvoiceDetail::where('category_id',$item->category_id)->where('product_id',$item->id)->where('invoice_detail_status','1')->sum('selling_qty');
                                @endphp

                            <tr>
                                <td> {{ $key+1}} </td> 
                                <td> {{ $item['supplier']['name'] }} </td> 
                                <td> {{ $item['unit']['name'] }} </td> 
                                <td> {{ $item['category']['name'] }} </td> 
                                <td> {{ $item->name }} </td> 
                                <td> <span class="btn btn-success"> {{ $buying_total  }}</span>  </td> 
                                <td> <span class="btn btn-info"> {{ $selling_total  }}</span> </td> 
                                <td> <span class="btn btn-danger"> {{ $item->quantity }}</span> </td> 
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection