@extends('customer.layout')
@section('title','checkout')

@section('content')
<section id="checkout">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
        <div class="checkout-area">
          <form id="orderForm">
          @csrf
            <div class="row">
              <div class="col-md-8">
                <div class="checkout-left">
                  <div class="panel-group" id="accordion">
                    <!-- Shipping Address -->
                    <div class="panel panel-default aa-checkout-billaddress">
                      <div class="panel-heading">
                        <h4 class="panel-title" style="color:#ff6666;">
                            Shippping Address
                        </h4>
                      </div>
                      <div id="" class="">
                        <div class="panel-body">
                         <div class="row">
                            <div class="col-md-9">
                              <div class="aa-checkout-single-bill">
                                <input type="text" placeholder="User Name*" name="name" value="{{$userData[0]->name}}">
                              </div>                             
                            </div>
                
                          </div> 
                      
                          <div class="row">
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="email" placeholder="Email Address*" name="email"  value="{{$userData[0]->email}}">
                              </div>                             
                            </div>
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="tel" placeholder="Phone*" name="mobile"  value="{{$userData[0]->mobile}}">
                              </div>
                            </div>
                          </div> 
                          <div class="row">
                            <div class="col-md-12">
                              <div class="aa-checkout-single-bill">
                                <textarea cols="8" rows="3" name="address">{{$userData[0]->address}}</textarea>
                              </div>                             
                            </div>                            
                          </div>   
                         
                            
                          <div class="row">
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="text" placeholder="City*" name="city" value="{{$userData[0]->city}}">
                              </div>                             
                            </div>
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="text" placeholder="Postcode / ZIP*" name="pincode" value="{{$userData[0]->pincode}}">
                              </div>
                            </div>
                          </div> 
                                       
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="checkout-right">
                  <h4>Order Summary</h4>
                  <div class="aa-order-summary-area">
                   <table class="table">
                       <thead>
                           <tr>
                               <th>Product</th>
                               <th>Price</th>
                           </tr>
                       </thead>
                       <tbody>
                       @php 
                       $totalPrice = 0;
                       @endphp
                       @foreach($cartData as $cartList)
                       @php
                       $totalPrice = $totalPrice + $cartList->price * $cartList->qty;
                       @endphp
                        <tr>
                          <td>{{$cartList->product_name}}<strong> x  {{$cartList->qty}}</strong></td>
                          <td><i class="fa fa-rupee"></i>{{$cartList->price * $cartList->qty}}</td>
                        </tr>
                        @endforeach
             
                        <tfoot>
                         <tr>
                          <th>Total</th>
                          <td><i class="fa fa-rupee"></i>{{$totalPrice}}</td>
                        </tr>
                      </tfoot>
                   </table>
                  </div>
                  <h4>Payment Method</h4>
                  <div class="aa-payment-method">                    
                    <label for="COD"><input type="radio" id="COD" name="payment_type" checked value="COD"> Cash on Delivery </label>
                    <label for="NETBANKING"><input type="radio" id="NETBANKING" name="payment_type" value="NETBANKING" > Via Paypal </label>   
                    <input type="submit" value="Place Order" class="aa-browse-btn" id="orderBtn">                
                  </div>
                  <div class="container mt-3"><h4 id="orderErrorMsg"></h4></div>
                </div>
              </div>
            </div>
          </form>
         </div>
       </div>
     </div>
   </div>
 </section>
@endsection