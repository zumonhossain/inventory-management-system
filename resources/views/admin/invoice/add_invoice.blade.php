@extends('layouts.admin')
@section('title')
    All Invoice
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header all_and_all">
                    <h4 class="user-registration"><i class="mdi mdi-account-circle"></i> Add Invoice Information </h4>
                    <a href="{{ route('all_invoice') }}" class="all_link"><i class="mdi mdi-grid"></i> All Invoice</a>
                </div>

                <!-- ====================================
                            1st Form UI Design Start
                =======================================-->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-1">
                            <div class="md-3">
                                <label for="example-text-input" class="form-label">Inv No</label>
                                <input class="form-control example-date-input" name="invoice_no" type="text" value=""  id="invoice_no" readonly style="background-color:#ddd" >
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="md-3">
                                <label for="example-text-input" class="form-label">Date</label>
                                <input class="form-control example-date-input" name="date" type="date"  id="date">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="md-3">
                                <label for="example-text-input" class="form-label">Category Name </label>
                                <select id="category_id" name="category_id" class="form-select select2" aria-label="Default select example">
                                    <option selected="">-- Select Category --</option>
                                    @foreach($categories as $item)
                                        <option value="{{ $item->category_id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="md-3">
                                <label for="example-text-input" class="form-label">Product Name </label>
                                <select name="product_id" id="product_id" class="form-select select2" aria-label="Default select example">
                                <option selected=""></option>
                            
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="md-3">
                                <label for="example-text-input" class="form-label">Stock(Pic/Kg)</label>
                                <input class="form-control example-date-input" name="current_stock_qty" type="text"  id="current_stock_qty" readonly style="background-color:#ddd" >
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="md-3">
                                <label for="example-text-input" class="form-label" style="margin-top:43px;">  </label>
                                <i class="btn btn-secondary btn-rounded waves-effect waves-light fas fa-plus-circle addeventmore"> Add More</i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ====================================
                            1st Form UI Design End
                =======================================-->



                <!-- ====================================
                            2nd Form UI Design Start
                =======================================-->
                <div class="card-body">
                    <form method="post" action="#">

                        @csrf

                        <table class="table-sm table-bordered" width="100%" style="border-color: #ddd;">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Product Name </th>
                                    <th width="7%">PSC/KG</th>
                                    <th width="10%">Unit Price </th> 
                                    <th width="15%">Total Price</th>
                                    <th width="7%">Action</th> 

                                </tr>
                            </thead>

                            <tbody id="addRow" class="addRow">
                                
                            </tbody>

                            <tbody>
                                <tr>
                                    <td colspan="4"> Discount</td>
                                    <td>
                                        <input type="text" name="discount_amount" id="discount_amount" class="form-control estimated_amount" placeholder="Discount Amount"  >
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4"> Grand Total</td>
                                    <td>
                                        <input type="text" name="estimated_amount" value="0" id="estimated_amount" class="form-control estimated_amount" readonly style="background-color: #ddd;" >
                                    </td>
                                    <td></td>
                                </tr>
                            </tbody>                
                        </table>

                        <br>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <textarea name="description" class="form-control" id="description" placeholder="Write Description Here"></textarea>
                            </div>
                        </div>
                        
                        <br>

                        <div class="row">
                            <div class="form-group col-md-3">
                                <label> Paid Status </label>
                                <select name="paid_status" id="paid_status" class="form-select">
                                    <option value="">Select Status </option>
                                    <option value="full_paid">Full Paid </option>
                                    <option value="full_due">Full Due </option>
                                    <option value="partial_paid">Partial Paid </option>
                                </select>
                                <input type="text" name="paid_amount" class="form-control paid_amount" placeholder="Enter Paid Amount" style="display:none;">
                            </div>

                            <div class="form-group col-md-9">
                                <label> Customer Name  </label>
                                <select name="customer_id" id="customer_id" class="form-select">
                                    <option value="">Select Customer </option>
                                    @foreach($customers as $item)
                                    <option value="{{ $item->customer_id }}">{{ $item->name }} - {{ $item->mobile_no }}</option>
                                    @endforeach
                                    <option value="0">New Customer </option>
                                </select>
                            </div> 
                        </div> <!-- // end row --> 

                        <br>

                        <!-- Hide Add Customer Form -->
                        <div class="row new_customer" style="display:none">
                            <div class="form-group col-md-4">
                                <input type="text" name="name" id="name" class="form-control" placeholder="Write Customer Name">
                            </div>
                            <div class="form-group col-md-4">
                                <input type="text" name="mobile_no" id="mobile_no" class="form-control" placeholder="Write Customer Mobile No">
                            </div>
                            <div class="form-group col-md-4">
                                <input type="email" name="email" id="email" class="form-control" placeholder="Write Customer Email">
                            </div>
                        </div>
                        <!-- End Hide Add Customer Form -->

                        <br>

                        <div class="form-group">
                            <button type="submit" class="btn btn-info" id="storeButton"> Invoice Store</button>
                        </div>
                    </form>
                </div>
                <!-- ====================================
                            2nd Form UI Design End
                =======================================-->

            </div>
        </div>
    </div>

    <script src="{{ asset('contents/admin') }}/assets/libs/jquery/jquery.min.js"></script>
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

    <script type="text/javascript">
        $(function(){
            $(document).on('change','#product_id',function(){
                var product_id = $(this).val();
                $.ajax({
                    url:"{{ route('check-product-stock') }}",
                    type: "GET",
                    data:{product_id:product_id},
                    success:function(data){                   
                        $('#current_stock_qty').val(data);
                    }
                });
            });
        });
    </script>

@endsection