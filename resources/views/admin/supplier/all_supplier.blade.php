@extends('layouts.admin')
@section('title')
    All Supplier
@endsection
@section('content')
<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header all_and_all">
                    <h4 class="user-registration"><i class="mdi mdi-account-circle"></i> All Supplier Information </h4>
                    <a href="{{ route('supplier_add_form') }}" class="all_link"><i class="mdi mdi-grid"></i> Add Supplier</a>
                </div>
                <div class="card-body">
                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Name</th> 
                                <th>Mobile Number </th>
                                <th>Email</th>
                                <th>Address</th> 
                                <th>Action</th>
                            </tr>
                        </thead>


                        <tbody>
                        	 
                        @foreach($suppliers as $key => $item)
                            <tr>
                                <td> {{ $key+1}} </td>
                                <td> {{ $item->name }} </td> 
                                <td> {{ $item->mobile_no }} </td> 
                                <td> {{ $item->email }} </td> 
                                <td> {{ $item->address }} </td> 
                                <td>
                                    <a href="{{ route('supplier_edit_form',$item->id) }}" class="btn btn-info sm" title="Edit Data">  <i class="fas fa-edit"></i> </a>
                                    <a href="{{ route('supplier_delete',$item->id) }}" class="btn btn-danger sm" title="Delete Data" id="delete">  <i class="fas fa-trash-alt"></i> </a>
                                </td>
                            </tr>
                        @endforeach
                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
@endsection