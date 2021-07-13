@extends('admin/layout')

@section('title','Category')

@section('heading','Category')

@section('category','active')

@section('add-category-btn')


@if(session()->has('message'))
    <span class="alert alert-success" id="msg">{{session('message')}}</span>

@endif

<a href="{{route('addCategory')}}">
    <button class="btn-sm au-btn au-btn-icon au-btn--blue">
    <i class="zmdi zmdi-plus"></i>add Category</button>
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
                                                <th>Category Name</th>
                                                <th>Category Slug</th>
                                                <th colspan="2">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                         @foreach($result as $data)
                                            <tr>
                                                <td>{{$data->id}}</td>
                                                <td>{{$data->category_name}}</td>
                                                <td>{{$data->category_slug}}</td>
                                                <td><a href="{{route('editCategory',['id'=>$data->id])}}" class="btn btn-sm btn-warning">Edit</a></td>
                                                <td><a href="category/delete/{{$data->id}}" class="btn btn-sm btn-danger">Delete</a></td>
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
