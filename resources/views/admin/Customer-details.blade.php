@extends('admin/layout')

@section('title','Customer Details')

@section('heading','User Details')

@section('customer','active')

@section('add-category-btn')
<a href="{{route('customer')}}">
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
                                                <td>ID</td>
                                                <td>{{$result->id}}</td>
                                            </tr>  

                                            <tr>
                                                <td>Name</td>
                                                <td>{{$result->name}}</td>
                                            </tr>  

                                            <tr>
                                                <td>Email Address</td>
                                                <td>{{$result->email}}</td>
                                            </tr>  

                                            <tr>
                                                <td>Mobile Number</td>
                                                <td>{{$result->mobile}}</td>
                                            </tr>  

                                            <tr>
                                                <td>Password</td>
                                                <td>{{$result->password}}</td>
                                            </tr>  

                                            <tr>
                                                <td>Address</td>
                                                <td>{{$result->address}}</td>
                                            </tr>  

                                            <tr>
                                                <td>City</td>
                                                <td>{{$result->city}}</td>
                                            </tr>  

                                            <tr>
                                                <td>Pin Code</td>
                                                <td>{{$result->pincode}}</td>
                                            </tr>  

                                            <tr>
                                                <td>Status</td>
                                                @if($result->status ==1)
                                                <td><a href="{{route('status',['id'=>$result->id])}}" class="btn btn-sm btn-danger">Deactive</a></td>
                                                @else
                                                <td><a href="{{route('status',['id'=>$result->id])}}" class="btn btn-sm btn-success">Active</a></td>
                                                @endif
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
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $('#msg').fadeOut(3000);
});    

</script>
