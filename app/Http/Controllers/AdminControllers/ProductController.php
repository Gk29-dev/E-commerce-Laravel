<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminModels\Product;
use App\Models\AdminModels\product_image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function showProduct(){

        $data = Product::get();

        $maxid = Product::max('id');

        return view('admin.product',['result'=>$data,'id' =>$maxid]);
    }

    public function showProductForm($product_id){
        
        $category = DB::table('categories')->get();
        $brandName = DB::table('brands')->get();
        return view('admin.addproduct',['category'=>$category, 'product_id'=>$product_id,'brand'=>$brandName]);
    }

    public function addProduct(Request $request, $product_id){

        $data = new Product();

        $request->validate([
 
              'product_name' => 'required|string|max:40',
              'brand_name' => 'required|max:20',
              'qty' => 'required|numeric',
              'price' => 'required|numeric',
              'mrp' => 'required|numeric',
              'product_deliver_in' => 'required',
              'product_slug' => 'required|unique:products',
              'images.*' => 'required|mimes:jpeg,jpg,png',
              'product_category' => 'required|not_in:0',
        ]);

        $data->id =$product_id;
        $data->product_name = $request->input('product_name');
        $data->brand = $request->input('brand_name');
        $data->short_desc = $request->input('short_desc');
        $data->desc = $request->input('desc');
        $data->price = $request->input('price');
        $data->mrp = $request->input('mrp');
        $data->Deliver_in = $request->input('product_deliver_in');
        $data->qty = $request->input('qty');
        $data->product_slug = $request->input('product_slug');
        $data->category_id = $request->input('product_category');
        $data->technical_specf = $request->input('technical_specf');

        if($request->hasFile('images')){

            $productImage = $request->file('images');
            // $extension = $brandImage->extension();

            $newProductImage= $productImage->getClientOriginalName();

               // $randNumber = rand(111111, 999999);

            // $newBrandImage = $randNumber.'.'.$extension;

            $productImage->storeAs('public/admin_assets/product_images/',$newProductImage);


        }
        $data->product_image = $newProductImage;
        $result = $data->save();

            if($result){
  
                $request->session()->flash('message','Insert New Product Successfully');
                return redirect()->route('product');
              }
               
    }

    public function showProductDetails($id){

        $data = Product::find($id);
        $category = DB::table('categories')->get();
        $brand = DB::table('brands')->get();

        return view('admin.productDetails',['result'=>$data,'category'=>$category,'brand'=>$brand]);
    }

    public function showEditProduct(Request $request, $id){

        $data = Product::find($id);
        $category = DB::table('categories')->get();
        $brand_name = DB::table('brands')->get();


        return view('admin.editProduct',['data'=>$data,'category'=>$category,'brand_name' => $brand_name]);
    }

    public function saveEditProduct(Request $request, $id){

       

        $data = Product::find($id);
    
        $oldProductImage = $data->product_image;

        $data->product_name =  $request->input('product_name');
        $data->brand = $request->input('brand_name');
        $data->category_id = $request->input('product_category');
        $data->product_slug = $request->input('product_slug');
        $data->price = $request->input('price');
        $data->mrp = $request->input('mrp');
        $data->qty = $request->input('qty');
        $data->short_desc = $request->input('short_desc');
        $data->desc = $request->input('desc');
        $data->Deliver_in = $request->input('product_deliver_in');
        $data->technical_specf = $request->input('technical_specf');
        
        if($request->hasFile('images')){

            $image = $request->file('images');
            $newProductImage = $image->getClientOriginalName();
            $image->storeAs('public/admin_assets/product_images/',$newProductImage);
            
            //Delete The Old Image
            Storage::delete('public/admin_assets/product_images/'.$oldProductImage);
        }
        else{
            $newProductImage = $oldProductImage;
        }
        $data->product_image = $newProductImage;

        $result = $data->save();
        if($result){

            $request->session()->flash('message','Changes Successfully Done!');
            return redirect()->route('product');
        }  
    }

    public function deleteProduct(Request $request, $id){

           $data = Product::find($id);
           $image = $data->product_image;
           Storage::delete('public/admin_assets/product_images/'.$image);

           $result = $data->delete();

           if($result){

            $request->session()->flash('message','Product Deleted Successfully');
            return redirect()->route('product');
        }
    }
}
