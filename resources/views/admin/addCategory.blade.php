@extends('admin/layout')

@section('title','Add Category')

@section('heading','Manage Category')

@section('category','active')


@section('add-category-btn')
<a href="{{route('category')}}">
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
                                            <h3 class="text-center title-2">Add Category</h3>
                                        </div>
                                        <hr>
                                        <form action="{{route('addCategory')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="category_name" class="control-label mb-1">Category Name</label>
                                                <input  name="category_name" type="text" class="form-control">
                                                 @error('category_name')
                                                     <small class="text-danger">{{$message}}</small>
                                                 @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="category_slug" class="control-label mb-1">Category Slug</label>
                                                <input  name="category_slug" type="text" class="form-control" >
                                                @error('category_slug')
                                                    <small class="text-danger">{{$message}}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="category_image" class="control-label mb-1">Upload Category Image</label>
                                                <input  name="category_image" type="file" class="form-control" >
                                                @error('category_image')
                                                    <small class="text-danger">{{$message}}</small>
                                                @enderror
                                            </div>

                                           
                                            <div>
                                                <button id="add_category" type="submit" class="btn btn-lg btn-info btn-block">
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