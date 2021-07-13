@extends('customer.layout')
@section('title','Email Verified')

@section('content')
 <div class="container" style="padding-top:200px;">
     <h3 class="text-center"></h3>
     <h4 class="mt-5 text-center font-weight-bold">Please Check Your Mail ({{$email}}) and Enter the Code</h4>
     <form  class="w-50 mx-auto mt-5" method="post" id="forgotCodeForm">
       @csrf
        <div class="form-group" >
          <label for="">Enter Code</label>
          <input type="text" name="forgotCode" class="form-control" id="">
          <input type="hidden" name="userEmail" value="{{$email}}">
        </div>

        <div class="form-group">
           <input type="submit" value="Verify" id="verifyCode" class="btn btn-sm btn-danger form-control">
        </div>
     </form>
     <p class="text-center text-danger" id="forgotCodeMsg"></p>
 </div>
@endsection