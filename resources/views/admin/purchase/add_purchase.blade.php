@extends('layouts.admin')
@section('title')
    Add Purchase
@endsection
@section('content')
    <script src="{{ asset('contents/admin') }}/assets/libs/jquery/jquery.min.js"></script>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header all_and_all">
                    <h4 class="user-registration"><i class="mdi mdi-account-circle"></i> Add Purchase Information </h4>
                    <a href="{{ route('all_purchase') }}" class="all_link"><i class="mdi mdi-grid"></i> All Purchase</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="md-3">
                                <label for="example-text-input" class="form-label">Date</label>
                                <input class="form-control example-date-input" name="date" type="date"  id="date">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="md-3">
                                <label for="example-text-input" class="form-label">Purchase No</label>
                                <input class="form-control example-date-input" name="purchase_no" type="text"  id="purchase_no">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="md-3">
                                <label for="example-text-input" class="form-label">Supplier Name </label>
                                <select id="supplier_id" name="supplier_id" class="form-select select2" aria-label="Default select example">
                                    <option selected="">Open this select menu</option>
                                    @foreach($suppliers as $item)
                                        <option value="{{ $item->supplier_id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="md-3">
                                <label for="example-text-input" class="form-label">Category Name </label>
                                <select name="category_id" id="category_id" class="form-select select2" aria-label="Default select example">
                                <option selected="">Open this select menu</option>
                                
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="md-3">
                                <label for="example-text-input" class="form-label">Product Name </label>
                                <select name="product_id" id="product_id" class="form-select select2" aria-label="Default select example">
                                <option selected="">Open this select menu</option>
                            
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="md-3">
                                <label for="example-text-input" class="form-label" style="margin-top:43px;">  </label>
                                <i class="btn btn-secondary btn-rounded waves-effect waves-light fas fa-plus-circle addeventmore"> Add More</i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form method="post" action="#">
                        @csrf
                        <table class="table-sm table-bordered" width="100%" style="border-color: #ddd;">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Product Name </th>
                                    <th>PSC/KG</th>
                                    <th>Unit Price </th>
                                    <th>Description</th>
                                    <th>Total Price</th>
                                    <th>Action</th> 
                                </tr>
                            </thead>

                            <tbody id="addRow" class="addRow">
                                
                            </tbody>

                            <tbody>
                                <tr>
                                    <td colspan="5"></td>
                                    <td>
                                        <input type="text" name="estimated_amount" value="0" id="estimated_amount" class="form-control estimated_amount" readonly style="background-color: #ddd;" >
                                    </td>
                                    <td></td>
                                </tr>
                            </tbody>                
                        </table><br>
                        <div class="form-group">
                            <button type="submit" class="btn btn-info" id="storeButton"> Purchase Store</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        $(function(){
            $(document).on('change','#supplier_id',function(){
                var supplier_id = $(this).val();
                $.ajax({
                    url:"{{ route('get-category') }}",
                    type: "GET",
                    data:{supplier_id:supplier_id},
                    success:function(data){
                        var html = '<option value="">Select Category</option>';
                        $.each(data,function(key,v){
                            html += '<option value=" '+v.category_id+' "> '+v.category.name+'</option>';
                        });
                        $('#category_id').html(html);
                    }
                })
            });
        });
    </script>

    <script type="text/javascript">
        $(function(){
            $(document).on('change','#category_id',function(){
                var category_id = $(this).val();
                $.ajax({
                    url:"{{ route('get-product') }}",
                    type: "GET",
                    data:{category_id:category_id},
                    success:function(data){
                        var html = '<option value="">Select Product</option>';
                        $.each(data,function(key,v){
                            html += '<option value=" '+v.product_id+' "> '+v.name+'</option>';
                        });
                        $('#product_id').html(html);
                    }
                })
            });
        });
    </script>

@endsection