@extends('admin/layout')

@section('title','Edit | Brand')

@section('heading','Manage Brand')

@section('brand','active')

@section('add-category-btn')
<a href="{{route('Brand')}}">
    <button class="btn btn-success btn-sm">Back</button>
</a>
@endsection

@section('main-content')
<div class="row m-t-30">
                            <div class="col-md-12">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">Manage Your Brand</div>
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h3 class="text-center title-2">Edit Brand's Details</h3>
                                        </div>
                                        <hr>
                                        @foreach($result as $result)
                                        <form action="{{route('saveEditBrand',['brand_id' =>$result->brand_id])}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="brand_name" class="control-label mb-1">Brand Name</label>
                                                <input  name="brand_name" type="text" class="form-control" value="{{$result->brand_name}}">
                                                 @error('brand_name')
                                                     <small class="text-danger">{{$message}}</small>
                                                 @enderror
                                            </div>

                                            @foreach($category as $list)
                                                @foreach($categoryid as $id)
                                                  @if($list->id == $id)
                                                    <div class="form-check">
                                                        <label for="" class="form-check-label">
                                                            <input checked type="checkbox" name="check[]" value="{{$list->id}}" id=""> {{$list->category_name}}
                                                        </label>
                                                    </div>
                                                   @endif
                                                @endforeach
                                            @endforeach
                                            @error('category_id')
                                                     <small class="text-danger">{{$message}}</small>
                                                 @enderror

                                            <div class="form-group">
                                                <label for="brand_image" class="control-label mb-1">Upload Brand Image</label>
                                                <input  name="brand_image" type="file" class="form-control" >
                                                @error('brand_image')
                                                    <small class="text-danger">{{$message}}</small>
                                                @enderror
                                            </div>

                                            <div class="my-3">
                                                <img src="{{asset('storage/admin_assets/brand_images/'.$result->brand_image)}}" style ="height:100px; width:100px;" alt="">
                                            </div>

                                           
                                            <div>
                                                <button id="add_category" type="submit" class="btn btn-lg btn-info btn-block">
                                                   Save Changes
                                                </button>
                                            </div>
                                        </form>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
@endsection