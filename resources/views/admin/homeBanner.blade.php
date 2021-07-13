@extends('admin/layout')

@section('title','Home Banner')

@section('heading','Home Banner')

@section('banner','active')

@section('add-category-btn')


@if(session()->has('message'))
    <span class="alert alert-success" id="msg">{{session('message')}}</span>

@endif

<a href="{{route('addBanner')}}">
    <button class="btn-sm au-btn au-btn-icon au-btn--blue">
    <i class="zmdi zmdi-plus"></i>add Home Banner</button>
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
                                                <th>Banner Name</th>
                                                <th>Banner Button Name</th>
                                                <th>Button Link</th>
                                                <th>Banner Image</th>
                                                <th colspan="2">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                         @foreach($result as $data)
                                            <tr>
                                                <td>{{$data->id}}</td>
                                                <td>{{$data->banner_name}}</td>
                                                <td>{{$data->btn_text}}</td>
                                                <td>{{$data->btn_link}}</td>
                                                <td><img src="{{asset('storage/admin_assets/banner_images/'.$data->banner_image)}}" style ="height:100px; width:200px;"  alt=""></td>
                                                <td><a href="{{route('editBanner',['id'=>$data->id])}}" class="btn btn-sm btn-warning">Edit</a></td>
                                                <td><a href="banner/delete/{{$data->id}}" class="btn btn-sm btn-danger">Delete</a></td>
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
