@extends('admin/layout')

@section('title','Order Details')

@section('heading','Order Details')

@section('orders','active')

@section('add-category-btn')
<a href="{{route('showOrder')}}">
    <button class="btn btn-success btn-sm">Back</button>
</a>
@endsection


@section('main-content')
@if(session()->has('message'))
 <p class="alert alert-success text-center">{{session()->get('message')}}</p>
@endif

<div class="row m-t-30">
    <div class="col-md-12">
        <!-- DATA TABLE-->
        <h2 class="text-center my-3">Shipping Address Details</h2>
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
                        <td>Name</td>
                        <td>{{$orderData[0]->customer_name}}</td>
                    </tr>

                    <tr>
                        <td>Email</td>
                        <td>{{$orderData[0]->customer_email}}</td>
                    </tr>

                    <tr>
                        <td>Mobile</td>
                        <td>{{$orderData[0]->mobile}}</td>
                    </tr>

                    <tr>
                        <td>Address</td>
                        <td>{{$orderData[0]->address}}</td>
                    </tr>

                    <tr>
                        <td>City</td>
                        <td>{{$orderData[0]->city}}</td>
                    </tr>

                    <tr>
                        <td>PinCode</td>
                        <td>{{$orderData[0]->pincode}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- END DATA TABLE-->
    </div>
</div>

<div class="row m-t-30">
    <div class="col-md-12">
        <!-- DATA TABLE-->
        <h2 class="text-center my-3">Payment Details</h2>
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
                        <td>Payment ID</td>
                        <td>{{$orderData[0]->payment_id}}</td>
                    </tr>

                    <tr>
                        <td>Payment Type</td>
                        <td>{{$orderData[0]->payment_type}}</td>
                    </tr>

                    <tr>
                        <td>Order ID</td>
                        <td>{{$orderData[0]->orders_id}}</td>
                    </tr>

                    <tr>
                        <td>Order Placed Date</td>
                        <td>{{$orderData[0]->added_on}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- END DATA TABLE-->
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="container p-5 mx-auto" style="background-color: white;">
            <form action="{{route('updateOrder',['orderID'=>$orderData[0]->orders_id])}}" class="form-inline justify-content-center">
                @csrf
                <div class="form-group p-3">
                    <label for="">Payment Status</label>
                    <select name="paymentStatus" id="" class="form-control mx-3">
                        @foreach($payment_status as $payment)
                          @if($orderData[0]->payment_status == $payment)
                            <option selected value="{{$payment}}">{{$payment}}</option>
                          @else
                           <option value="{{$payment}}">{{$payment}}</option>
                          @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group p-3">
                    <label for="">Order Status</label>
                    <select name="orderStatus" id="" class="form-control mx-3">
                        @foreach($orderStatus as $order)
                          @if($orderData[0]->order_status == $order->id)
                            <option selected value="{{$order->id}}">{{$order->order_status}}</option>
                          @else
                            <option value="{{$order->id}}">{{$order->order_status}}</option>
                          @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" value="update" class="form-control btn btn-sm btn-success" >
                </div>
            </form>
        </div>
    </div>
</div>

<div class="row m-t-30">
    <div class="col-md-12">
        <!-- DATA TABLE-->
        <h2 class="text-center my-3">Product Details</h2>
        <div class="table-responsive m-b-40">
            <table class="table table-borderless table-data3 text-center">
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Product Image</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                   @php $grandtotal =0; @endphp
                    @foreach($orderData as $list)
                    <tr>
                        <td>{{$list->product_id}}</td>
                        <td><img src="{{asset('storage/admin_assets/product_images/'.$list->product_image)}}" style="max-width:30%;"></td>
                        <td>{{$list->product_name}}</td>
                        <td>{{$list->price}}</td>
                        <td>{{$list->qty}}</td>
                        <td><i class="fa fa-rupee"></i>{{$list->price * $list->qty}}</td>
                        @php
                        $grandtotal = $grandtotal + ($list->price * $list->qty); 
                        @endphp 
                    </tr>
                    @endforeach
                    <tr>
                     <td colspan="4"></td>                           
                    <td><b>GrandTotal</b></td>
                    <td><b><i class="fa fa-rupee"></i>{{$grandtotal}}</b></td>
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
    $(document).ready(function() {
        $('#msg').fadeOut(3000);
    });
</script>