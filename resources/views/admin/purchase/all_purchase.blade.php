@extends('layouts.admin')
@section('title')
    All Purchase
@endsection
@section('content')
<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header all_and_all">
                    <h4 class="user-registration"><i class="mdi mdi-account-circle"></i> All Purchase Information </h4>
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
                            <tr>
                                <td>..</td>
                                <td>..</td>
                                <td>..</td>
                                <td>..</td>
                                <td>..</td>
                                <td>..</td>
                                <td>..</td>
                                <td>..</td>
                                <td>
                                    <a href="#" class="btn btn-danger sm" title="Delete Data" id="delete">  <i class="fas fa-trash-alt"></i> </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection