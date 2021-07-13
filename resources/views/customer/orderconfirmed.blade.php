@extends('customer.layout')
@section('title','Order Confirmed')

@section('content')

@if(session()->has('ORDER_ID'))
 <div class="container" style="padding-top:200px;">
     <h3 class="mt-5 text-center">Your Order Has been Placed</h3>
       <h4 class="text-center">Your Order ID: {{session()->get('ORDER_ID')}}</h4>
     <a type="button" href="/" class=" btn btn-danger my-4 text-white">Go To Home Page</a>
 </div>
 @else
    <script>
        window.location.href='/';
    </script>
@endif    
    
@endsection