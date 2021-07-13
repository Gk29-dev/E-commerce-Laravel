@extends('admin/layout')

@section('title','Product')

@section('heading','Product')

@section('product','active')

@section('add-category-btn')


@if(session()->has('message'))
    <span class="alert alert-success" id="msg">{{session('message')}}</span>

@endif
@php
$next_id = 1;
if(isset($result)){
    
        $next_id = $next_id + $id;
}

  

@endphp
<a href="product/add_product/{{$next_id}}">
    <button class="btn-sm au-btn au-btn-icon au-btn--blue">
    <i class="zmdi zmdi-plus"></i>add Product</button>
</a>
@endsection

@section('main-content')
<div class="row m-t-30">
                            <div class="col-md-12">
                                <!-- DATA TABLE-->
                                <div class="table-responsive m-b-40">
                                    <table class="table table-borderless table-data3 text-center striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Product Name</th>
                                                <th>Brand Name</th>
                                                <th>Product Slug</th>
                                                <th>Price</th>
                                                <th>MRP</th>
                                                <th>Quantity</th>
                                                <th colspan="2" style="text-align: center;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                         @foreach($result as $data)
                                            <tr>
                                                <td>{{$data->id}}</td>
                                                <td>{{$data->product_name}}</td>
                                                <td>{{$data->brand}}</td>
                                                <td>{{$data->product_slug}}</td>
                                                <td>{{$data->price}}</td>
                                                <td>{{$data->mrp}}</td>
                                                <td>{{$data->qty}}</td>
                                                <td><a href="{{route('editProduct',['id'=>$data->id])}}" class="btn btn-sm btn-warning">Edit</a>
                                                 <a href="{{route('product_details',['id' => $data->id])}}" class="btn btn-sm btn-info">View</a>
                                                <a href="product/delete/{{$data->id}}" class="btn btn-sm btn-danger">Delete</a></td>
                                            </tr>
                                         @endforeach   
                                        </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE-->
                            </div>
                        </div>
                        
   @php 
    
   @endphp
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $('#msg').fadeOut(3000);
});    

</script>
