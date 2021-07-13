@extends('admin/layout')

@section('title','Customer')

@section('heading','User List')

@section('customer','active')

@section('add-category-btn')


@if(session()->has('message'))
    <span class="alert alert-success" id="msg">{{session('message')}}</span>

@endif

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
                                                <th>Name</th>
                                                <th>E-mail</th>
                                                <th>Mobile</th>
                                                <th>City</th>
                                                <th colspan="2">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                         @foreach($result as $data)
                                            <tr>
                                                <td>{{$data->id}}</td>
                                                <td>{{$data->name}}</td>
                                                <td>{{$data->email}}</td>
                                                <td>{{$data->mobile}}</td>
                                                <td>{{$data->city}}</td>
                                                <td><a href="{{route('customerDetails',['id'=>$data->id])}}" class="btn btn-sm btn-warning">View</a></td>

                                                <!-- Check The Status  -->
                                                @if($data->status ==1)
                                                <td><a href="{{route('status',['id'=>$data->id])}}" class="btn btn-sm btn-danger">Deactive</a></td>
                                                @else
                                                <td><a href="{{route('status',['id'=>$data->id])}}" class="btn btn-sm btn-success">Active</a></td>
                                                @endif
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
