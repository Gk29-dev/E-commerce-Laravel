<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminModels\Customer;

class CustomerController extends Controller
{
    public function showCustomer(){

        $data = Customer::get();

        return view('admin.Customers',['result'=>$data]);
    }

    public function showCustomerDetails($id){

        $result = Customer::find($id);

        return view('admin.Customer-details',['result'=>$result]);
    }

    public function manageCustomerStatus($id){

        $data = Customer::find($id);

        $status = $data->status;
         if($status == 1){

            $status = 0;
            $data->status = $status;
            $data->save();
            
         }
         else{
             $status = 1;
             $data->status = $status;
             $data->save();
         }

        session()->flash('message','Status Change');

         return redirect()->route('customer');

    }
}
