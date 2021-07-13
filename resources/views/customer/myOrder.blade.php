@extends('customer.layout')
@section('title', 'My Order')

@section('content')
<section id="cart-view">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="cart-view-area">
          <div class="cart-view-table">
            <form>
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Order ID</th>
                      <th>Payment Status</th>
                      <th>Payment Type</th>
                      <th>Order Status</th>
                      <th>Payment ID</th>
                      <th>Total Amount</th>
                      <th>Order Placed Date</th>
                    </tr>
                  </thead>
                  <tbody>
                     @foreach($result as $list) 
                    <tr>
                      <td><a href="{{route('orderDetail',['orderID'=>$list->orders_id])}}" class="btn btn-sm btn-info">{{$list->orders_id}}</a></td>
                      <td>{{$list->payment_status}}</td>
                      <td>{{$list->payment_type}}</td>
                      <td>{{$list->order_status}}</td>
                      <td>{{$list->payment_id}}</td>
                      <td>{{$list->total_amount}}</td>
                      <td>{{$list->added_on}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </form>
            <!-- Cart Total view -->
         
          </div>
        </div>
      </div>
    </div>
  </div>

</section>
@endsection