<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\AdminModels\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       if(session()->has('ADMIN_LOGIN')){
           return redirect()->route('dashboard');
       } 
       else{
        return view('admin.login');
       }
      
    }

    public function auth(Request $request)
    {
      $email = $request->input('email');
      $password = md5($request->input('password'));

    //   echo "Email:".$email;
    //   echo "password:".$password;

     $result = Admin::where(['email'=>$email,'password'=>$password])->get();

 

      if(isset($result[0]->id)){
          echo "login Successfully";

          $id = $result[0]->id;
          
          //if login successfully Done
          $request->session()->put('ADMIN_LOGIN',true);
          $request->session()->put('ADMIN_ID', $id);
          return redirect('admin/dashboard');
      }
      else{

          $request->session()->flash('error','Incorrect Email Or Password');
          return redirect('admin');
      }
    }

    public function dashboard()
    {
       return view('admin.dashboard');
    }

    public function logout(){

        if(session()->has('ADMIN_LOGIN')){

           session()->flush();

           session()->flash('error','Logout Successfully');

           return redirect()->route('admin');
        }
    }

    // public function updatePassword(){

    //     $request = Admin::find(1);

    //      $request->password = md5('ankit1998');
    //      $result =$request->save();

    //    if($result){
    //        echo 'Update Done';
    //    }
    //    else{
    //        echo 'not Updated';
    //    }
        
    // }


   
}
