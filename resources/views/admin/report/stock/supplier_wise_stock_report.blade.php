@extends('layouts.admin')
@section('title')
    Supplier Wise Report
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
                        <li class="breadcrumb-item active">Supplier Wise Stock Report</li>
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

                                        <h3 class="text-center" style="text-transform: uppercase"><strong>Supplier Name : </strong> {{ $allData['0']['supplier']['name'] }} </h3>

                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <td><strong>Sl </strong></td>
                                                    <td class="text-center"><strong>Supplier Name </strong></td>
                                                    <td class="text-center"><strong>Unit  </strong></td>
                                                    <td class="text-center"><strong>Category</strong></td>
                                                    <td class="text-center"><strong>Product Name</strong></td>
                                                    <td class="text-center"><strong>Stock  </strong></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($allData as $key => $item)
                                                    <tr>
                                                        <td class="text-center"> {{ $key+1}} </td> 
                                                        <td class="text-center"> {{ $item['supplier']['name'] }} </td> 
                                                        <td class="text-center"> {{ $item['unit']['name'] }} </td> 
                                                        <td class="text-center"> {{ $item['category']['name'] }} </td> 
                                                        <td class="text-center"> {{ $item->name }} </td> 
                                                        <td class="text-center"> {{ $item->quantity }} </td> 
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