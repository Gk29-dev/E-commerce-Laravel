@extends('admin/layout')

@section('title','All Orders')

@section('heading','Orders')

@section('orders','active')


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
                                                <th>Order ID</th>
                                                <th>Customer ID</th>
                                                <th>Total Amount</th>
                                                <th>Order Status</th>
                                                <th>Payment Status</th>
                                                <th>Payment Type</th>
                                                <th>Order Date</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($allOrder as $list)
                                            <tr>
                                                <td>{{$list->orders_id}}</td>
                                                <td>{{$list->customer_id}}</td>
                                                <td>{{$list->total_amount}}</td>
                                                <td>{{$list->order_status}}</td>
                                                <td>{{$list->payment_status}}</td>
                                                <td>{{$list->payment_type}}</td>
                                                <td>{{$list->added_on}}</td>
                                                <td><a href="/admin/order/{{$list->orders_id}}" class="btn btn-sm btn-info">View</a></td>
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
