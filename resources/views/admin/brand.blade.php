@extends('admin/layout')

@section('title','Brand')

@section('heading','Brand Details')

@section('brand','active')

@section('add-category-btn')


@if(session()->has('message'))
    <span class="alert alert-success" id="msg">{{session('message')}}</span>

@endif

<a href="{{route('addBrand')}}">
    <button class="btn-sm au-btn au-btn-icon au-btn--blue">
    <i class="zmdi zmdi-plus"></i>add Brand</button>
</a>
@endsection

@section('main-content')
<div class="row m-t-30">
                            <div class="col-md-12">
                                <!-- DATA TABLE-->
                                <div class="table-responsive m-b-40">
                                    <table class="table table-borderless table-data3 text-center">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Brand Name</th>
                                                <th>Brand Image </th>
                                                <th>Category Name</th>
                                                <th colspan="2">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                         @foreach($result as $key => $data)
                                            <tr>
                                                <td>{{$data->brand_id}}</td>
                                                <td>{{$data->brand_name}}</td>
                                                <td><img src="{{asset('storage/admin_assets/brand_images/'.$data->brand_image)}}" alt="" style ="height:70px; width:100px;"></td>
                                                <td>
                                                    @foreach($categoryList as $key => $list)
                                                    @if($data->brand_id ==$key)
                                                        @foreach($list as $abc)
                                                        @foreach($abc as $xyz)
                                                           {{$xyz->category_name}}&nbsp;&nbsp;&nbsp;
                                                        @endforeach
                                                        @endforeach
                                                      @endif
                                                    @endforeach
                                                </td>
                                                <td><a href="{{route('editBrand',['brand_id'=>$data->brand_id])}}" class="btn btn-sm btn-warning mx-2">Edit</a>
                                                <a href="brand/delete/{{$data->brand_id}}" class="btn btn-sm btn-danger">Delete</a></td>
                                            </tr>
                                         @endforeach   
                                        </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE-->
                            </div>
                        </div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $('#msg').fadeOut(3000);
});    

</script>
