@extends('admin/layout')

@section('title','Product Details')

@section('heading','Product Details')

@section('product','active')

@section('add-category-btn')
<a href="{{route('product')}}">
    <button class="btn btn-success btn-sm">Back</button>
</a>
@endsection 


@if(session()->has('message'))
    <span class="alert alert-success" id="msg">{{session('message')}}</span>

@endif





@section('main-content')
<div class="row m-t-30">
                            <div class="col-md-12">
                                <!-- DATA TABLE-->
                                <div class="table-responsive m-b-40">
                                    <table class="table table-borderless table-data3 text-center">
                                        <thead>
                                            <tr>
                                                <th>Field Name</th>
                                                <th>Value</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          
                                            <tr>
                                                <td>Product ID</td>
                                                <td>{{$result->id}}</td>
                                            </tr>

                                            <tr>
                                                <td>Product Name</td>
                                                <td>{{$result->product_name}}</td>
                                            </tr>  

                                            <tr>
                                                <td>Brand Name</td>
                                                <td>{{$result->brand}}</td>
                                            </tr>  

                                            <tr>
                                                <td>Product Slug</td>
                                                <td>{{$result->product_slug}}</td>
                                            </tr>  

                                            <tr>
                                                <td>Category</td>
                                               @foreach($category as $cate)
                                                 @if($cate->id == $result->category_id)
                                                <td>{{$cate->category_name}}</td>
                                                @endif
                                                @endforeach
                                            </tr>  

                                            <tr>
                                                <td>Price</td>
                                                <td>{{$result->price}}</td>
                                            </tr>  

                                            <tr>
                                                <td>MRP</td>
                                                <td>{{$result->mrp}}</td>
                                            </tr>  

                                            <tr>
                                                <td>Deliver In</td>
                                                <td>{{$result->Deliver_in}}</td>
                                            </tr> 
                                            
                                            <tr>
                                                <td>Quantity</td>
                                                <td>{{$result->qty}}</td>
                                            </tr> 

                                            <tr>
                                                <td>Short Description</td>
                                                <td>{{$result->short_desc}}</td>
                                            </tr> 

                                            <tr>
                                                <td>Description</td>
                                                <td>{{$result->desc}}</td>
                                            </tr>

                                               <tr>
                                                <td>Technical Specification</td>
                                                <td>{{$result->technical_specf}}</td>
                                            </tr> 

                                            <tr>
                                                <td>Action</td>
                                                <td><a href="{{route('editProduct',['id'=>$result->id])}}" class="btn btn-sm btn-warning">Edit</a>
                                                <a href="product/delete/{{$result->id}}" class="btn btn-sm btn-danger">Delete</a></td>
                                            </tr>  

                                            <tr>
                                                <td>Created Date</td>
                                                <td>{{\Carbon\Carbon::parse($result->created_at)->format('d-m-Y')}}</td>
                                            </tr>  
                                        </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE-->
                            </div>
                        </div>

                        <div class="card" id="img">
                            <div class="card-header">Product Images</div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4 col-sm-8" style="width: 200px; height:200px;">
                                        <img src="{{asset('storage/admin_assets/product_images/'.$result->product_image)}}"  style="width: 150px; height:150px;" alt="">
                                    </div>
                                </div>
                            </div>
                         </div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $('#msg').fadeOut(3000);
});    

</script>
