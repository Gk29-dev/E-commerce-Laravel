@extends('customer.layout')
@section('title','Order Detail')

@section('content')
<section id="cart-view" class="mb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="cart-view-area">
                    <div class="cart-view-table">
                            <h2 class="text-center my-3">Shipping Address Details</h2>
                                <table class="table w-50 mx-auto">
                                    <tr>
                                        <th>Name</th>
                                        <td>{{$orderDetail[0]->customer_name}}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{$orderDetail[0]->customer_email}}</td>
                                    </tr>

                                    <tr>
                                        <th>Mobile</th>
                                        <td>{{$orderDetail[0]->mobile}}</td>
                                    </tr>
                                    <tr>
                                        <th>Address</th>
                                        <td>{{$orderDetail[0]->address}}</td>
                                    </tr>
                                    <tr>
                                        <th>City</th>
                                        <td>{{$orderDetail[0]->city}}</td>
                                    </tr>

                                    <tr>
                                        <th>PinCode</th>
                                        <td>{{$orderDetail[0]->pincode}}</td>
                                    </tr>
                                </table>
                        <!-- Cart Total view -->

                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

<section id="cart-view" class="mb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="cart-view-area">
                    <div class="cart-view-table">
                            <h2 class="text-center">Order Details</h2>
                            <table class="table w-100">
                              <thead>
                                  <tr>
                                      <th>Product ID</th>
                                      <th>Product Image</th>
                                      <th>Product Name</th>
                                      <th>Brand Name</th>
                                      <th>Price</th>
                                      <th>Quantity</th>
                                      <th>Total</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @php $grandtotal =0; @endphp
                                  @foreach($orderDetail as $list)
                                   <tr>
                                       <td>{{$list->product_id}}</td>
                                       <td><img src="{{asset('storage/admin_assets/product_images/'.$list->product_image)}}" alt=""></td>
                                       <td>{{$list->product_name}}</td>
                                       <td>{{$list->brand}}</td>
                                       <td>{{$list->price}}</td>
                                       <td>{{$list->qty}}</td>
                                       <td>{{$list->price * $list->qty}}</td>
                                       @php
                                       $grandtotal = $grandtotal + ($list->price * $list->qty); 
                                       @endphp 
                                   </tr>
                                  @endforeach
                                  <tr>
                                      <td colspan="5"></td>
                                      <td>GrandTotal</td>
                                      <td>{{$grandtotal}}</td>
                                  </tr>
                              </tbody>
                            </table>
                        
                        <!-- Cart Total view -->

                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

@endsection