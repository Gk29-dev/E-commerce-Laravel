<?php

namespace App\Http\Controllers\AdminControllers;


use App\Http\Controllers\Controller;
use App\Models\AdminModels\Brand;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Testing\Fluent\Concerns\Has;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    public function showBrand(){

        $data = Brand::get();
      
        foreach($data as $list){
           
            $abc['name'][$list->brand_id] = explode(',',$list->category_id);

            foreach($abc['name'][$list->brand_id] as $key => $val){
                $categoryname[$list->brand_id][] = DB::table('categories')->where('id',$val)->get();
                
            }
          
           
        }
   

          return view('admin.brand',['result'=>$data,'categoryList'=>$categoryname]);
    }

    public function showBrandForm(){

        $category = DB::table('categories')->get();
        return view('admin.addBrand',['category' => $category]);
    }

    public function addBrand(Request $request){

        $categoryValues = $request->input('check');
        $categoryID = implode(',',$categoryValues);
     
        $model = new Brand;

        $request->validate([

             'brand_name' => 'required|unique:brands',
             'brand_image' => 'required|mimes:jpeg,jpg,png',
        ]);

        $model->brand_name = $request->input('brand_name');
        $model->category_id = $categoryID; 

               
        if($request->hasFile('brand_image')){

            $brandImage = $request->file('brand_image');
            $extension = $brandImage->extension();
            $randNumber = rand(111111, 999999);
            $newBrandImage= $randNumber.'.'.$extension;

               

            // $newBrandImage = $randNumber.'.'.$extension;

            $brandImage->storeAs('public/admin_assets/brand_images/',$newBrandImage);


        }

        $model->brand_image = $newBrandImage;
        $result= $model->save();

        if($result){
            $request->session()->flash('message','Insert New Brand Successfully');
            return redirect()->route('Brand');
        }
    }

    public function showEditBrand($brand_id){

         $data = Brand::where('brand_id',$brand_id)->get();
         $category = DB::table('categories')->get();

          $categoryid = explode(',',$data[0]->category_id);
        
    
         return view('admin.editBrand',['result'=>$data,'category'=>$category,'categoryid'=>$categoryid]);
    }

    public function saveEditBrand(Request $request, $id){

        $data = Brand::where('brand_id',$id)->get();
        $categoryValues = $request->input('check');
        $categoryID = implode(',',$categoryValues);

        if($request->hasFile('brand_image')){

            $new_image = $request->file('brand_image');

            $extension = $new_image->extension();
            $randNumber = rand(111111, 999999);
            $newBrandImage = $randNumber.'.'.$extension;

            $new_image->storeAs('public/admin_assets/brand_images/',$newBrandImage);

            Storage::delete('public/admin_assets/brand_images/'.$data[0]->brand_image);
        }

        else{

            $newBrandImage = $data[0]->brand_image;
        }

        $result = Brand::where('brand_id',$id)->update([

            'brand_name' => $request->input('brand_name'),
            'brand_image' => $newBrandImage,
            'category_id' => $categoryID,
        ]);

        if($result){
            $request->session()->flash('message','Update Brand Details Successfully');
            return redirect()->route('Brand');
        }
    }

    public function deleteBrand(Request $request,$id){

        $data =Brand::where('brand_id',$id)->get();

        $result = Brand::where('brand_id',$id)->delete();

        if($result){

            Storage::delete('public/admin_assets/brand_images/'.$data[0]->brand_image);

            $request->session()->flash('message','Delete Brand Details Successfully');
            return redirect()->route('Brand');
        }
    }
}
