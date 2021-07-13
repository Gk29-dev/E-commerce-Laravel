<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminModels\Category;
use Illuminate\Support\Facades\Storage;

class categoryController extends Controller
{
    public function showCategory(){

        $result = Category::all();

        return view('admin.category',['result'=>$result]);
    }

    public function showCategoryForm(){

        return view('admin.addCategory');
    }

    public function addCategory(Request $request){

        // $request->post(); we can show the whole data using post() method

        // $name = $request->post('category_name'); //store the category name value using post() method

      $request->validate([
         
         'category_name' => 'required|unique:categories',
         'category_slug' => 'required|unique:categories',
         'category_image' => 'required'
      ]);
       
      $data = new Category();

      $data->category_name = $request->input('category_name');
      $data->category_slug = $request->input('category_slug');

      if($request->hasFile('category_image')){

        $categoryImage = $request->file('category_image');
        // $extension = $brandImage->extension();

        $newCategoryImage= $categoryImage->getClientOriginalName();

           // $randNumber = rand(111111, 999999);

        // $newBrandImage = $randNumber.'.'.$extension;

        $categoryImage->storeAs('public/admin_assets/category_images/',$newCategoryImage);
        $data->category_image = $newCategoryImage;

    }

      $result = $data->save();

      if($result){

        $request->session()->flash('message','Insert New Category Successfully');
        return redirect('admin/category');
      }
      
      
    }

    public function showEditCategory(Request $request, $id){

        $data = Category::find($id);
        return view('admin.editCategory',['data'=>$data]);
    }

    public function saveEditCategory(Request $request, $id){

        $data = Category::find($id);


        $request->validate([
             
             'category_name' => 'required',
             'category_slug' =>'required',
        ]);

        if($request->hasFile('category_image')){

            $new_image = $request->file('category_image');

            $CategoryImage = $new_image->getClientOriginalName();

            $new_image->storeAs('public/admin_assets/category_images/',$CategoryImage);

            Storage::delete('public/admin_assets/category_images/'.$data->category_image);
        }

        else{

            $CategoryImage = $data->category_image;
        }

        $result = Category::where('id',$id)->update([
             
             'category_name' => $request->category_name,
             'category_slug' => $request->category_slug,
             'category_image' => $CategoryImage,
        ]);

        if($result){

            $request->session()->flash('message','Changes Successfully Done!');
            return redirect()->route('category');
        }
    }

    public function deleteCategory(Request $request,$id){

        $data = Category::find($id);
       $result= $data->delete();
        
       if($result){

           Storage::delete('public/admin_assets/category_images/'.$data->category_image);
           $request->session()->flash('message','Category Deleted Successfully');
           return redirect()->route('category');
       }
    }

}
