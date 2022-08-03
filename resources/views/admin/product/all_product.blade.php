@extends('layouts.admin')
@section('title')
    All Product
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header all_and_all">
                    <h4 class="user-registration"><i class="mdi mdi-account-circle"></i> All Product Information </h4>
                    <a href="{{ route('add_product') }}" class="all_link"><i class="mdi mdi-grid"></i> Add Product</a>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Name</th> 
                                <th>Supplier Name </th>
                                <th>Unit</th>
                                <th>Category</th> 
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $key => $item)
                                <tr>
                                    <td> {{ $key+1}} </td>
                                    <td> {{ $item->name }} </td> 
                                    <td> {{ $item->supplier->name }} </td> 
                                    <td> {{ $item->unit->name }} </td> 
                                    <td> {{ $item->category->name }}</td>
                                    <td>
                                        <a href="{{ route('edit_product',$item->id) }}" class="btn btn-info sm" title="Edit Data">  <i class="fas fa-edit"></i> </a>
                                        <a href="{{ route('delete_product',$item->id) }}" class="btn btn-danger sm" title="Delete Data" id="delete">  <i class="fas fa-trash-alt"></i> </a>
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