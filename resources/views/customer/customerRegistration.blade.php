@extends('customer.layout')
@section('title','User Registration')

@section('content')
<section id="aa-myaccount">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
        <div class="aa-myaccount-area">         
            <div class="row">
              <div class="col-md-6">
                <div class="aa-myaccount-register">                 
                 <h4>Register</h4>

                           @if(session('msg'))
                         
                           <div class="alert alert-success alert-dismissible show">
                                <button class="close" type="button" data-dismiss="alert">&times;</button>
                               <p>{{session('msg')}}</p>
                            </div>
                           @endif 
               
                 <form action="{{route('userRegistrationForm')}}" class="aa-login-form" method="POST">
                     @csrf
                     <div class="form-group">
                        <label for="">Username<span>*</span></label>
                        <input type="text" placeholder="ex: Gaurav" name="name">
                        @error('name')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Email Address<span>*</span></label>
                        <input type="email" placeholder="ex: abc@gmail.com" name="email">
                        @error('email')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="">Password<span>*</span></label>
                        <input type="password" placeholder="ex: abc123$" name="password">
                        @error('password')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Mobile Number<span>*</span></label>
                        <input type="text" placeholder="Enter Mobile Number" name="mobile">
                        @error('mobile')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <button type="submit" class="aa-browse-btn">Register</button>                    
                  </form>
                </div>
              </div>
            </div>          
         </div>
       </div>
     </div>
   </div>
 </section>
@endsection