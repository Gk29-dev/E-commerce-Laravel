@extends('admin/layout')

@section('title','Add Home Banner')

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
                                    <div class="card-header">Manage Your Category</div>
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h3 class="text-center title-2">Add Home Banner</h3>
                                        </div>
                                        <hr>
                                        <form action="{{route('addBanner')}}" method="post" enctype="multipart/form-data">
                                            @csrf

                                            <div class="form-group">
                                                <label for="banner_name" class="control-label mb-1">Banner Name</label>
                                                <input  name="banner_name" type="text" class="form-control">
                                                 @error('banner_name')
                                                     <small class="text-danger">{{$message}}</small>
                                                 @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="btn_text" class="control-label mb-1">Banner Button Name</label>
                                                <input  name="btn_text" type="text" class="form-control">
                                                 @error('btn_text')
                                                     <small class="text-danger">{{$message}}</small>
                                                 @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="btn_link" class="control-label mb-1">Button Link</label>
                                                <input  name="btn_link" type="text" class="form-control" >
                                                @error('btn_link')
                                                    <small class="text-danger">{{$message}}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="banner_image" class="control-label mb-1">Upload Banner Image</label>
                                                <input  name="banner_image" type="file" class="form-control" >
                                                @error('banner_image')
                                                    <small class="text-danger">{{$message}}</small>
                                                @enderror
                                            </div>

                                           
                                            <div>
                                                <button id="add_banner_image" type="submit" class="btn btn-lg btn-info btn-block">
                                                   Add
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
@endsection