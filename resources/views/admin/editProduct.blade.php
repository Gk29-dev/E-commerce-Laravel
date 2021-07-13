@extends('admin/layout')

@section('title','Edit Product')

@section('heading','Manage Product')


@section('add-category-btn')
<a href="{{route('product')}}">
    <button class="btn btn-success btn-sm">Back</button>
</a>
@endsection

@section('main-content')
<div class="row m-t-30">
                            <div class="col-md-12">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">Manage Your Product</div>
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h3 class="text-center title-2">Edit Product</h3>
                                        </div>
                                        <hr>
                                        <form action="{{route('saveEditProduct',['id'=>$data->id])}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="product_name" class="control-label mb-1">Product Name</label>
                                                <input  name="product_name" type="text" class="form-control" value="{{$data->product_name}}">
                                                 @error('product_name')
                                                     <small class="text-danger">{{$message}}</small>
                                                 @enderror
                                            </div>
                    
                                        <div class="row">

                                            <div class="col-lg-4 col-sm-12">
                                                <div class="form-group  mt-4">
                                                    <label for="product_category">Category</label>
                                                    <select name="product_category" class="form-control">
                                                        
                                                        @foreach($category as $cate)
                                                            @if($data->category_id == $cate->id)
                                                            <option selected value="{{$cate->id}}">{{$cate->category_name}}</option>
                                                            
                                                            @else
                                                            <option value="{{$cate->id}}">{{$cate->category_name}}</option>
                                                            @endif
                                                            
                                                                           
                                                        @endforeach
                                                    </select>
                                                    @error('product_category')
                                                        <small class="text-danger">{{$message}}</small>
                                                    @enderror
                                                
                                                </div>
                                            </div>    

                                            <div class="col-lg-4 col-sm-12">
                                                <div class="form-group  mt-4">
                                                    <label for="short_desc" class="control-label mb-1">Product Slug</label>
                                                    <input type="text" name="product_slug" value="{{$data->product_slug}}" class="form-control">
                                                </div>
                                            </div>    
                                           
                                            <div class="col-lg-4 col-sm-12">
                                                <div class="form-group mt-4">
                                                    <label for="brand_name" class="control-label mb-1">Product Brand Name</label>
                                                    <select name="brand_name" id="" class="form-control">
                                        
                                                      @foreach($brand_name as $name)
                                                        @if($data->brand == $name->brand_name)
                                                           <option selected value="{{$data->brand}}">{{$data->brand}}</option>
                                                        @else 
                                                        <option  value="{{$name->brand_name}}">{{$name->brand_name}}</option>
                                                        @endif
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
                                                <label for="qty" class="control-label mb-1">Quantity</label>
                                                <input  name="qty" type="text" class="form-control" value="{{$data->qty}}">
                                                @error('qty')
                                                    <small class="text-danger">{{$message}}</small>
                                                @enderror
                                            </div>

                                            </div>

                                                    <div class="col-lg-6 col-sm-12">
                                                        <div class="form-group mt-4">
                                                            <label for="product_deliver_in" class="control-label mb-1">Product Delivered In</label>
                                                            <input name="product_deliver_in" type="text" class="form-control" value="{{$data->Deliver_in}}">
                                                            @error('product_deliver_in')
                                                            <small class="text-danger">{{$message}}</small>
                                                            @enderror   
                                                        </div>
                                                    </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-lg-6 col-sm-12">

                                            <div class="form-group  mt-4">
                                                <label for="price" class="control-label mb-1">Product Price</label>
                                                <input  name="price" type="text" class="form-control" value="{{$data->price}}">
                                                @error('price')
                                                    <small class="text-danger">{{$message}}</small>
                                                @enderror
                                            </div>

                                            </div>

                                                    <div class="col-lg-6 col-sm-12">
                                                        <div class="form-group mt-4">
                                                            <label for="mrp" class="control-label mb-1">Product MRP</label>
                                                            <input name="mrp" type="text" class="form-control" value="{{$data->mrp}}">
                                                            @error('mrp')
                                                            <small class="text-danger">{{$message}}</small>
                                                            @enderror   
                                                        </div>
                                                    </div>
                                        </div>

                                            <!-----Product Images--->
                                            <div class="card" id="img">
                                                <div class="card-header">Product Images</div>

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

                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <img src="{{asset('storage/admin_assets/product_images/'.$data->product_image)}}" alt="">
                                                </div>
                                            </div>

                                        <div class="row">
                                            <div class="col-lg-12 col-sm-12">
                                                <div class="form-group  mt-4">
                                                    <label for="short_desc" class="control-label mb-1">Short Description</label>
                                                    <textarea name="short_desc" id="" cols="10" rows="2" class="form-control">{{$data->short_desc}}</textarea>
                                                </div>   
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-12 col-sm-12">
                                                <div class="form-group  mt-4">
                                                    <label for="desc" class="control-label mb-1">Description</label>
                                                    <textarea name="desc" id="" cols="10" rows="5" class="form-control">{{$data->desc}}</textarea>
                                                </div>   
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-12 col-sm-12">
                                                <div class="form-group  mt-4">
                                                    <label for="technical_specf" class="control-label mb-1">Technical Specification</label>
                                                    <textarea name="technical_specf" id="" cols="10" rows="4" class="form-control">{{$data->technical_specf}}</textarea>
                                                </div>   
                                            </div>
                                        </div>
                        
                                            <div>
                                                <button id="add_category" type="submit" class="btn btn-lg btn-info btn-block">
                                                  Save Changes
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
@endsection