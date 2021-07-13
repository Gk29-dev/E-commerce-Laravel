<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use GrahamCampbell\ResultType\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;

class Customer extends Controller
{
  
   public function index(){
   $result = DB::table('categories')->get();
   $banner = DB::table('home_banners')->get();

   foreach($result as $list){

      $data[$list->id] = DB::table('products')->where('category_id',$list->id)->get();
       
   }
    return view('customer.index',['result'=>$result,'data'=>$data,'banner' => $banner]);
   }

   public function showProductDetails($slug){
      $productData = DB::table('products')->where('product_slug',$slug)->get();
      $relProduct = DB::table('products')->where('category_id',$productData[0]->category_id)->get();

      
      return view('customer.product-details',['productData' =>$productData,'relProduct'=>$relProduct]);
   }

   public function addToCart(Request $request){
     
    
    if($request->session()->has('LOGIN_USER_ID')){
       $uid = $request->session()->get('LOGIN_USER_ID');
       $user_type = "Reg";
    }
    else{
       return response()->json(["status"=>false]);
    }
  
    $product_id = $request->post('product_id');
    $product_qty_selected = $request->post('pqty');
    $product = DB::table('products')->where('id',$product_id)->get();

    $check = DB::table('cart')
             ->where('user_id',$uid)
             ->where('user_type',$user_type)
             ->where('product_id',$product_id)
            ->get();
      

       if(isset($check[0])){ //For Update The Cart

         $update_id = $check[0]->cart_id;

         $updateData = DB::table('cart')
                     ->where('cart_id',$update_id)->update([
                       'qty' => $product_qty_selected
                     ]);
         
            $msg = "Update The Cart Successfully!";
            return response()->json(['cartmsg'=>$msg]);

                    
       }
       
       else{
          
           $insertDataInCart = DB::table('cart')->insert([
               'user_id' => $uid,
               'user_type' => $user_type,
               'qty' => $product_qty_selected,
               'product_id' => $product_id,
               'added_on' => date('Y-m-d h:i:s'),
           ]);
           if($insertDataInCart){
            $msg = "Product Successfully Add In the Cart!";
            $totalcartProduct =countViewCart();
            return response()->json(['cartmsg'=>$msg,'countCartProduct'=>$totalcartProduct]);
           }
       }
   }
   public function viewCartProduct(Request $request){
      if(session()->has('LOGIN_USER_ID')){
            $uid = $request->session()->get('LOGIN_USER_ID');
            $result = DB::table('cart')
                     ->select('cart.cart_id','cart.qty','cart.product_id','products.product_name','products.price','products.product_image','products.qty as productqty')
                     ->join('products','cart.product_id','=','products.id')
                     ->where('user_id',$uid)->get();
   
         return view('customer.cart',['cartProduct'=>$result]);
     }
     else{
        return view('customer.cart',['cartProduct'=>0]);
     }
   }

   public function deleteCartProduct(Request $request, $pid){

      $uid = $request->session()->get('LOGIN_USER_ID');
      $data = DB::table('cart')->where('user_id',$uid)
              ->where('product_id',$pid)
              ->delete();
       return redirect()->route('viewCartProduct');       
   }

   public function showCategoryProduct($categorySlug){

      $category = DB::table('categories')->where('category_slug',$categorySlug)->get();
  
      $fetchProduct = DB::table('products')->where('category_id',$category[0]->id)->paginate(4);
      $allCategory = DB::table('categories')->get();

     
      return view('customer.category',['fetchProduct' =>$fetchProduct,'category'=>$allCategory,'category_id' =>$category[0]->id]);
   }

   public function priceRange(Request $request,$id){
       $minValue = $request->get('min');
       $maxValue = $request->get('max');

       $result = DB::table('products')
                 ->where('category_id',$id)            
                 ->whereBetween('price',[$minValue,$maxValue])->get();

      $allCategory = DB::table('categories')->get();


      return view('customer.category',['fetchProduct' =>$result,'category'=>$allCategory,'category_id'=>$id]);
   }

   public function auto_suggestion_product(Request $request){

      $productName = $request->post('productName');
      $html = '';
      $result = DB::table('products')->where('product_name','like',"%{$productName}%")->get();
      
      if(isset($result)){
            $html.= '<ul>';
            foreach($result as  $product){
            $html.= '<li>'.$product->product_name.'</li>';
            }
            $html.= '</ul>';
            
            echo $html;
      }
      else{
         $html= "Product Not Found";
         echo $html;
      }

   }

   public function searchProduct(Request $request){
      $productname = $request->get('search-product'); 
      $productData = DB::table('products')->where('product_name',$productname)->get();

      $relProduct = DB::table('products')->where('category_id',$productData[0]->category_id)->get();

      
      return view('customer.product-details',['productData' =>$productData,'relProduct'=>$relProduct]);

      
   }

   public function userRegistration(){
      if(session()->has('LOGIN_USER_STATUS')){
         return redirect('/');
      }
      return view('customer.customerRegistration');
   }

   public function userRegistrationForm(Request $request){
      
            $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:customers',
            'password'=>'required|alpha_num',
            'mobile'=>'required|digits:10'
            ]);

            $rand_id = rand(111111111,999999999);
            $result = DB::table('customers')->insert([
            'name' => $request->post('name'),
            'email' =>$request->post('email'),
            'password'=> Crypt::encrypt($request->post('password')),
            'mobile'=> $request->post('mobile'),
            'status'=> 1,
            'is_email_verified' => 0,
            'rand_id' => $rand_id,
            'created_at'=> date('Y-m-d h:i:s'),
            'updated_at'=> date('Y-m-d h:i:s')

            ]);

            $userData = ['name'=>$request->post('name'), 'data'=>$rand_id];
            $user['to'] = $request->post('email');
            Mail::send('customer.mail',$userData,function($msg) use ($user){
               $msg->to($user['to']);
               $msg->subject('Email Verification');
            });
            if($result){
               $msg = "Registration Successfully. Please Check Your Email for Verification Thank You!";
               $request->session()->flash('msg',$msg);
               return view('customer.customerRegistration');
            }
            else{
               echo "Failed";
            }
         
   }

   public function userLoginForm(Request $request){
      $email = $request->post('loginEmail');
      $password = $request->post('loginPassword');
      $rememberMe = $request->post('rememberme');

      $dbResult = DB::table('customers')->where('email',$email)->get();
     
      if(isset($dbResult[0])){
         $dbPassword = Crypt::decrypt($dbResult[0]->password);
        if($password == $dbPassword){

           if($dbResult[0]->is_email_verified == 0){
              $msg = "Your Email is Not Verified";
              return response()->json(['status'=>false,'msg'=>$msg]);
           }
           $status = true;
           $msg = "Login Successsfully";
  
           $request->session()->put('LOGIN_USER_STATUS',true);
           $request->session()->put('LOGIN_USER_ID',$dbResult[0]->id);
           $request->session()->put('LOGIN_USER_NAME',$dbResult[0]->name);

           if($rememberMe === null){

            setcookie('USER_EMAIL_COOKIE',$email,100,'/');
            setcookie('USER_PASSWORD_COOKIE',$password,100,'/');

           }else{
              setcookie('USER_EMAIL_COOKIE',$email,time() + 60*60*24*30,'/');
              setcookie('USER_PASSWORD_COOKIE',$password,time() + 60*60*24*30,'/');
           }

           return response()->json(['status'=>$status,'msg'=>$msg]);

        }
        else{
           $msg = "Password is Incorrect";
           return response()->json(['status'=>false,'msg'=>$msg]);
        }
      }

   else{
      $msg = "Email is Incorrect";
      return response()->json(['status'=>false,'msg'=>$msg]);
   }
 }

 public function emailVerified($rand_id){

   $result = DB::table('customers')->where('rand_id',$rand_id)->get();

   if(isset($result[0])){
      $updateEmailStatus = DB::table('customers')->where('id',$result[0]->id)->update(['is_email_verified'=>1]);
         return view('customer.email_verified');
      
   }
 }

 public function productCheckout(Request $request){
    if(session()->has('LOGIN_USER_ID')){

       $userID = $request->session()->get('LOGIN_USER_ID');
      $cartData = DB::table('cart')
                  ->select('cart.cart_id','cart.user_id','cart.qty','products.id','products.product_name','products.price')
                  ->join('products', 'cart.product_id','=','products.id')
                  ->where('cart.user_id',$userID)
                  ->get();
      $userData = DB::table('customers')->where('id',$userID)->get();

      return view('customer.checkout',['cartData'=>$cartData,'userData'=>$userData]);
    
    }
    else{
        return redirect('/');
    }
 }

 public function userLogout(Request $request){
 
   $request->session()->forget('LOGIN_USER_STATUS');
   $request->session()->forget('LOGIN_USER_ID');
   $request->session()->forget('LOGIN_USER_NAME');

   return redirect('/');
 }

 public function placeOrder(Request $request){

   if(session()->has('LOGIN_USER_ID')){
      $grandtotal =0;
      $userID = session()->get('LOGIN_USER_ID');
      
      $cartData =DB::table('cart')
               ->select('cart.cart_id','cart.user_id','cart.qty','products.id','products.product_name','products.price','products.qty as productqty')
               ->join('products', 'cart.product_id','=','products.id')
               ->where('cart.user_id',$userID)
               ->get();         
      
      foreach($cartData as $list){
         $grandtotal = $grandtotal + ($list->qty * $list->price);
      }
      
      $orders_id = DB::table('orders')->insertGetId([
          
         'customer_id' => $userID,
         'customer_name' => $request->post('name'),
         'customer_email' => $request->post('email'),
         'mobile' => $request->post('mobile'),
         'address' => $request->post('address'),
         'city' => $request->post('city'),
         'pincode'=> $request->post('pincode'),
         'order_status' => 1,
         'payment_type' => $request->post('payment_type'),
         'payment_status'=>'Pending',
         'payment_id' =>0,
         'total_amount' => $grandtotal,
         'added_on'=> date('Y-m-d')
      ]);

      if(isset($orders_id)){
         foreach($cartData as $list){
       
         $result = DB::table('order_details')->insert([
            'orders_id' => $orders_id,
            'product_id' => $list->id,
            'price' => $list->price,
            'qty' => $list->qty,
         ]);

         $updateProductQuantity = DB::table('products')->where('id',$list->id)->update([
            'qty' => ($list->productqty - $list->qty), 
         ]);
            
         }
         if($result){
            $request->session()->put('ORDER_ID',$orders_id);
            DB::table('cart')->where('user_id',$userID)->delete();
            return response()->json(['status'=>true]);
         } 
         else{
            return response()->json(['status'=>false,'msg'=>'Your Order is not Placed Try Later!']);
         }

      }
      else{
         echo "Failed";
      }
   }else{
      return redirect('/');
   }
 }

 public function orderconfirmed(){
    return view('customer.orderconfirmed');
 }

 public function myOrder(Request $request){

   $userID = $request->session()->get('LOGIN_USER_ID');
   $result = DB::table('orders')
             ->join('order_status','orders.order_status','=','order_status.id')
            ->where('customer_id',$userID)->get();       
  
    return view('customer.myOrder',['result'=>$result]);
 }

 public function orderDetail(Request $request,$orderID){
   $userID = $request->session()->get('LOGIN_USER_ID');

   $orderDetail = DB::table('order_details')
                 ->select('order_details.*','orders.*','products.product_name','products.brand','products.product_image')
                 ->join('orders','orders.orders_id','=','order_details.orders_id')
                 ->join('products','order_details.product_id','=','products.id')
                 ->where('orders.orders_id',$orderID)
                 ->where('orders.customer_id',$userID)
                 ->get();


   return view('customer.orderDetail',['orderDetail'=>$orderDetail]);

 }

 public function forgotPassword(Request $request){
    
   $email = $request->post('forgotEmail');
   $verifyEmail = DB::table('customers')->where('email',$email)->get();

   if($verifyEmail[0]->email == $email){
    $forgot_id = rand(111111,999999);

   $result = DB::table('customers')->where('email',$verifyEmail[0]->email)->update([
      'forgot_id' => $forgot_id,
   ]); 
    $userData = ['name'=>$verifyEmail[0]->name, 'data'=>$forgot_id];
    $user['to'] = $email;
    Mail::send('customer.forgotCode',$userData,function($msg) use ($user){
       $msg->to($user['to']);
       $msg->subject('Forgot Password');
 
    });

   if($result){
      return response()->json(['status'=>true,'email'=>$email]); 
      // return view('customer.forgotPasswordCode',['email'=>$verifyEmail[0]->email,'msg'=>'Code Successfully Send']); 
   }
   else{
      return response()->json(['status'=>false,'msg'=>'Some Technical Issue Occur, Please Try Again!']); 
   }
    
   }else{
      return response()->json(['status'=>'error','msg'=>'Invalid Email Address']);
   }
 }

  public function showForgotCodeForm($email){
  return view('customer.forgotPasswordCode',['email'=>$email]);
 }

 public function forgotPasswordCode(Request $request){
   $email = $request->post('userEmail');

   $userData = DB::table('customers')->where('email',$email)->get();
   $enteredCode = $request->post('forgotCode');

   if($userData[0]->forgot_id == $enteredCode){
      return response()->json(['status'=>true,'msg'=>'Verify','email'=>$email]);
   }
   else{
      return response()->json(['status'=>false,'msg'=>'Invalid Code']);
   }

 }

 public function showNewPasswordForm(Request $request){
  $email = $request->get('email');
  return view('customer.showNewPasswordForm',['email'=>$email]);
 }

 public function setNewPassword(Request $request){
   $email = $request->post('userEmail');
   $newPassword = Crypt::encrypt($request->post('newPassword'));

   $result = DB::table('customers')->where('email',$email)->update([
      'password' => $newPassword,
   ]);
   if($result){
    return response()->json(['status'=>true,'msg'=>'new password has been set']);
   }
   else{
    return response()->json(['status'=>false,'msg'=>'password changes failed']);
   }
 }

}
