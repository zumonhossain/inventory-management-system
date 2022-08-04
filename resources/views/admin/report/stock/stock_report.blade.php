@extends('layouts.admin')
@section('title')
    All Stock Report
@endsection
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Report</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);"> </a></li>
                        <li class="breadcrumb-item active">Stock</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="invoice-title">
                                <h3>
                                    <img src="{{ asset('contents/admin/assets/images/logo-sm.png') }}" alt="logo" height="24"/> Zumon Hossain Traders limited
                                </h3>
                            </div>
                            <hr>
                            
                            <div class="row">
                                <div class="col-6 mt-4">
                                    <address>
                                        <strong>Zumon Hossain Traders limited:</strong><br>
                                        Dhanmondi Dhaka<br>
                                        zumonhossain@gmail.com
                                    </address>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div>
                                <div class="p-2"></div>
                                <div class="">
                                    <div class="table-responsive">
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


                                    <div class="">

                                        <i>Printing Time : {{ $date->format('F j, Y, g:i a') }}</i>

                                        <div class="float-end d-print-none">
                                            <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light"><i class="fa fa-print"></i></a>
                                            <a href="#" class="btn btn-primary waves-effect waves-light ms-2">Download</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end row -->
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection