@extends('admin/layout')

@section('title','Edit Home Banner')

@section('heading','Manage Home Banner')

@section('banner','active')


@section('add-category-btn')
<a href="{{route('Banner')}}">
    <button class="btn btn-success btn-sm">Back</button>
</a>
@endsection


@section('main-content')
<div class="row m-t-30">
                            <div class="col-md-12">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">Manage Your Home Banner</div>
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h3 class="text-center title-2">Edit Home Banner</h3>
                                        </div>
                                        <hr>
                                        <form action="{{route('saveEditBanner',['id'=>$result->id])}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="banner_name" class="control-label mb-1">Banner Name</label>
                                                <input  name="banner_name" type="text" class="form-control" value="{{$result->banner_name}}">
                                                 @error('banner_name')
                                                     <small class="text-danger">{{$message}}</small>
                                                 @enderror
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="btn_text" class="control-label mb-1">Banner Button Name</label>
                                                <input  name="btn_text" type="text" class="form-control" value="{{$result->btn_text}}">
                                                 @error('btn_text')
                                                     <small class="text-danger">{{$message}}</small>
                                                 @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="btn_link" class="control-label mb-1">Button Link</label>
                                                <input  name="btn_link" type="text" class="form-control" value="{{$result->btn_link}}" >
                                                @error('btn_link')
                                                    <small class="text-danger">{{$message}}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="banner_image" class="control-label mb-1">Banner Image</label>
                                                <input  name="banner_image" type="file" class="form-control" >
                                                @error('banner_image')
                                                    <small class="text-danger">{{$message}}</small>
                                                @enderror
                                            </div>

                                            <div class="my-3">
                                                <img src="{{asset('storage/admin_assets/banner_images/'.$result->banner_image)}}" style ="height:100px; width:200px;" alt="">
                                            </div>

                                           
                                            <div>
                                                <button id="add_category" type="submit" class="btn btn-lg btn-info btn-block">
                                                   Save Changes
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
@endsection