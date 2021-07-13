<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminModels\homeBanner;
use Illuminate\Support\Facades\Storage;

class HomeBannerController extends Controller
{
    public function showBanner(){
     
        $result = homeBanner::get();
        return view('admin.homeBanner',['result'=>$result]);
    }

    public function showBannerForm(){

        return view('admin.addHomeBanner');
    }
    public function addBanner(Request $request){

        $model = new homeBanner;

            
            $request->validate([

                'btn_text' => 'required',
                'btn_link' => 'required',
                'banner_image' => 'required||mimes:jpeg,jpg,png',
                'banner_name' => 'required',
        ]);
                $model->banner_name = $request->input('banner_name');
                $model->btn_text = $request->input('btn_text');
                $model->btn_link = $request->input('btn_link');        
                if($request->hasFile('banner_image')){

                    $bannerImage = $request->file('banner_image');
                    // $extension = $brandImage->extension();

                    $newBannerImage= $bannerImage->getClientOriginalName();

                        // $randNumber = rand(111111, 999999);

                    // $newBrandImage = $randNumber.'.'.$extension;

                    $bannerImage->storeAs('public/admin_assets/banner_images/',$newBannerImage);


                }

                $model->banner_image = $newBannerImage;
                $result= $model->save();

                if($result){
                    $request->session()->flash('message','Insert New Banner Successfully');
                    return redirect()->route('Banner');
                }

    }

    public function showEditBanner($id){

        $result = homeBanner::find($id);
        return view('admin.editHomeBanner',['result' => $result]);
    }

    public function saveEditBanner(Request $request, $id){

        $data = homeBanner::find($id);

        if($request->hasFile('banner_image')){

            $new_image = $request->file('banner_image');

            $newBannerImage = $new_image->getClientOriginalName();

            $new_image->storeAs('public/admin_assets/banner_images/',$newBannerImage);

            Storage::delete('public/admin_assets/banner_images/'.$data->banner_image);
        }

        else{

            $newBannerImage = $data->banner_image;
        }

        $result = homeBanner::where('id',$id)->update([

            'banner_name' => $request->input('banner_name'),
            'btn_text' => $request->input('btn_text'),
            'banner_image' => $newBannerImage,
            'btn_link' => $request->input('btn_link'),
        ]);

        if($result){
            $request->session()->flash('message','Update Banner Details Successfully');
            return redirect()->route('Banner');
        }
    }

    public function deleteBanner(Request $request,$id){

    
        $data = homeBanner::find($id);

        $result = homeBanner::where('id',$id)->delete();

        if($result){

            Storage::delete('public/admin_assets/banner_images/'.$data->banner_image);

            $request->session()->flash('message','Delete Banner Details Successfully');
            return redirect()->route('Banner');
        }
    }
}
