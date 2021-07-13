@extends('admin/layout')

@section('title','Add Product')

@section('heading','Manage Product')

@section('product','active')

@section('add-category-btn')
<a href="{{route('product')}}">
    <button class="btn btn-success btn-sm">Back</button>
</a>
@endsection

@section('main-content')
<div class="row m-t-30">
    <div class="col-md-12">
        <div class="col-lg-12">
            <form action="{{route('addProduct',['product_id'=>$product_id])}}" method="post" enctype="multipart/form-data">
                <div class="card">
                    <div class="card-header">Manage Your Product {{$product_id}}</div>
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Add Product</h3>
                        </div>
                        <hr>
                        @csrf
                        <div class="form-group">
                            <label for="product_name" class="control-label mb-1">Product Name</label>
                            <input name="product_name" type="text" class="form-control">
                            @error('product_name')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-sm-12">
                              <div class="form-group  mt-4">
                                 <label for="">Select Category</label>
                                    <select name="product_category" class="form-control" id="select_category">
                                        <option value="" >Select Product Category</option>
                                        @foreach($category as $data)
                                        <option value="{{$data->id}}">{{$data->category_name}}</option>
                                        @endforeach
                                    </select>
                                        @error('product_category')
                                        <small class="text-danger">{{$message}}</small>
                                        @enderror
                                 </div>
                            </div>

                            <div class="col-lg-6 col-sm-12">
                                    <div class="form-group mt-4">
                                        <label for="brand_name" class="control-label mb-1">Product Brand Name</label>
                                        <select name="brand_name" id="" class="form-control">
                                            <option value="disabled">--------Select Brand----------</option>
                                            @foreach($brand as $name)
                                            <option value="{{$name->brand_name}}">{{$name->brand_name}}</option>
                                            @endforeach
                                        </select>
                                        @error('brand_name')
                                        <small class="text-danger">{{$message}}</small>
                                        @enderror
                                </div> 
                            </div>
                        </div>


                        <div class="row">

                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group  mt-4">
                                    <label for="product_slug" class="control-label mb-1">Product Slug</label>
                                    <input name="product_slug" type="text" class="form-control">
                                    @error('product_slug')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-12">
                            
                                    <div class="form-group mt-4">
                                        <label for="product_deliver_in" class="control-label mb-1">Product Delivered In</label>
                                        <input name="product_deliver_in" type="text" class="form-control">
                                        @error('product_deliver_in')
                                        <small class="text-danger">{{$message}}</small>
                                        @enderror
                                     </div>
                            </div>
                        </div>
                       

                    

                      

                        <div class="form-group  mt-4">
                            <label for="short_desc" class="control-label mb-1">Short Description</label>
                            <textarea name="short_desc" id="" cols="10" rows="2" class="form-control"></textarea>
                        </div>

                        <div class="form-group  mt-4">
                            <label for="desc" class="control-label mb-1">Description</label>
                            <textarea name="desc" id="" cols="10" rows="5" class="form-control"></textarea>
                        </div>

                        <div class="form-group  mt-4">
                            <label for="technical_specf" class="control-label mb-1">Technical Specification</label>
                            <textarea name="technical_specf" id="" cols="10" rows="4" class="form-control"></textarea>
                        </div>

                    </div>
                </div>

                <!-----Product Images--->
                <div class="card" id="img">
                    <div class="card-header">Add Product Images</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 col-sm-8">
                                <input type="file" name="images" class="form-control">
                                @error('images')
                                   <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>


                <!-----Product Attributes--->

                <div class="card">
                    <div class="card-header">Product Attributes</div>

                    <div class="card-body" id="img">
                        <div class="row">
                            <div class="col-lg-4 col-sm-4">
                                <label for="qty">Qty</label>
                                <input type="number" name="qty" class="form-control" value="1">
                            </div>
                            <div class="col-lg-4 col-sm-4">
                                <label for="price">Price</label>
                                <input type="text" name="price" class="form-control" placeholder="$ 10.00">
                                @error('price')
                                 <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-sm-4">
                                <label for="mrp">MRP</label>
                                <input type="text" name="mrp" class="form-control" placeholder="$ 20.00">
                                @error('mrp')
                                     <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        @error('product_images')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>

                <!----Form Submit Button--->
                <div>
                    <button id="add_category" type="submit" class="btn btn-lg btn-info btn-block">
                        Add Product
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection