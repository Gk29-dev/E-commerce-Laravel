@extends('customer/layout')

@section('title','Cart Page')
@section('content')

<section id="cart-view">
  @php $grandtotal=0; @endphp
  @if(isset($cartProduct[0]))
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="cart-view-area">
          <div class="cart-view-table">
            <form>
              <div class="">
                <table class="table">
                  <thead>
                    <tr>
                      <th></th>
                      <th></th>
                      <th>Product</th>
                      <th>Price</th>
                      <th>Quantity</th>
                      <th>Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($cartProduct as $cart)
                    @php
                    $total = $cart->price * $cart->qty;
                    $grandtotal = $grandtotal + $total;
                    @endphp
                    <tr>
                      <td><a class="remove" href="{{route('deleteCartProduct',['pid' => $cart->product_id])}}">
                          <fa class="fa fa-close"></fa>
                        </a></td>
                      <td><a href="#"><img src="{{asset('storage/admin_assets/product_images/'.$cart->product_image)}}" alt="img"></a></td>
                      <td><a class="aa-cart-title" href="#">{{$cart->product_name}}</a></td>
                      <td><i class="fa fa-rupee"></i>&nbsp;{{$cart->price}}</td>
                      <td><input class="aa-cart-quantity" type="number" onchange="updateCart('{{$cart->product_id}}','{{$cart->price}}','{{ $total}}','{{$cart->productqty}}')" name="qty" id="qty{{$cart->product_id}}" value="{{$cart->qty}}"></td>
                      <td id="total{{$cart->product_id}}">{{$cart->price * $cart->qty}}</td>

                    </tr>

                    @endforeach
                  </tbody>
                </table>
              </div>
            </form>
            <!-- Cart Total view -->
            <div class="cart-view-total">
              <h4>Cart Totals</h4>
              <table class="aa-totals-table table w-100">
                <tbody>
                  <tr>
                    <th>Subtotal</th>
                    <td class="abc">{{$grandtotal}}</td>
                  </tr>
                  <tr>
                    <th>Total</th>
                    <td class="abc">{{$grandtotal}}</td>
                  </tr>
                </tbody>
              </table>
              <a href="{{route('productCheckout')}}" class="aa-cart-view-btn">Proced to Checkout</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @else
  <div class="container w-50 mx-auto" style="height: 300px;">
    <h3 style="margin-top:100px;" class="text-center">Cart is Empty</h3>
  </div>
  @endif
</section>


<form id="updateCart">
  @csrf
  <input type="hidden" name="product_id" id="product_id">
  <input type="hidden" name="pqty" id="pqty">
  <input type="hidden" name="grandtotal" id="grandtotal" value="{{$grandtotal}}">
</form>
<script>
  
  function updateCart(pid, price, total,productQty){
    var totalprice = Number(total);
    var productQty = Number(productQty);
    var qty = $("#qty"+pid).val();
    if(qty>productQty){
      alert('Not Enough Quantity');
      $("#qty"+pid).val(productQty);
    }
    else{
      $("#product_id").val(pid);
      $("#pqty").val(qty);

    
        $.ajax({
          url: "{{route('addToCart')}}",
          type: "POST",
          data: $("#updateCart").serialize(),
          success: function(data) {
            $("#total" + pid).html(qty * price);
            var x = $("#grandtotal").val();
            var grandtotal = Number(x);
            var new_price = (qty * price);
            if (new_price > totalprice) {
              var rem = (new_price - totalprice);
              var finaltotal = (grandtotal + rem);
            } else {
              var rem = (totalprice - new_price);
              var finaltotal = (grandtotal - rem);
            }
            $('.abc').html(finaltotal);


          }
        });
     }
  }
</script>
@endsection