<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function showOrder(){

    $allOrder = DB::table('orders')->join('order_status','orders.order_status','=','order_status.id')->get();

    return view('admin.allOrder',['allOrder'=>$allOrder]);
    }

    public function orderDetail($orderID){
        $orderData =  DB::table('orders')
                    ->select('order_details.*','orders.*','products.product_name','products.brand','products.product_image')
                    ->join('order_details','orders.orders_id','=','order_details.orders_id')
                    ->join('products','order_details.product_id','=','products.id')
                    ->where('orders.orders_id',$orderID)
                    ->get();

        $orderStatus = DB::table('order_status')->get();
        $payment_status = array('Pending','Success','Failed');
               
        return view('admin.orderDetail',['orderData'=>$orderData,'orderStatus'=>$orderStatus,'payment_status'=>$payment_status]);            
    }

    public function updateOrder(Request $request, $orderID){
       $paymentStatus = $request->get('paymentStatus');
       $orderStatus = $request->get('orderStatus');

       $updateStatus = DB::table('orders')->where('orders_id',$orderID)->update([
                 'order_status' => $orderStatus,
                 'payment_status' => $paymentStatus,
       ]);

       if($updateStatus){
          $request->session()->flash('message','Payment and Order Status has Been Updated');
          return redirect('/admin/order/'.$orderID);
       }
       else{
                $request->session()->flash('message','Not Updated Try After Sometime...');
                return redirect()->route('/admin/order/'.$orderID);
       }
    }
}
