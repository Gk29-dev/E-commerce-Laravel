@extends('customer.layout')
@section('title','Set New Password')

@section('content')
 <div class="container" style="padding-top:200px;">
     <h3 class="text-center"></h3>
     <h4 class="mt-5 text-center font-weight-bold">Set New Password</h4>
     <form  class="w-50 mx-auto mt-5" method="post" id="setNewPassword">
       @csrf
        <div class="form-group" >
          <label for="">Enter New Password</label>
          <input type="text" name="newPassword" class="form-control" id="newPassword">
          <input type="hidden" name="userEmail" value="{{$email}}">
        </div>

          <div class="form-group" >
          <label for="">Re-Enter The Password</label>
          <input type="text" name="reNewPassword" class="form-control" id="reNewPassword">
        </div>

        <div class="form-group">
           <input type="submit" value="Set Password" id="setPassword" class="btn btn-sm btn-danger form-control">
           <p class="text-center text-danger" id="passwordMismatch"></p>
        </div>
     </form>
     <p class="text-center text-danger" id="PasswordMsg"></p>
 </div>
@endsection