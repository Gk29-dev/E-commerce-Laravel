@extends('admin/layout')

@section('title','Add Brand')

@section('heading','Manage Brand')


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
                                            <h3 class="text-center title-2">Add Brand</h3>
                                        </div>
                                        <hr>
                                        <form action="{{route('addBrand')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="brand_name" class="control-label mb-1">Brand Name</label>
                                                <input  name="brand_name" type="text" class="form-control">
                                                 @error('brand_name')
                                                     <small class="text-danger">{{$message}}</small>
                                                 @enderror
                                            </div>

        
                                              
                                                    @foreach($category as $list)
                                                    <div class="form-check">
                                                        <label for="" class="form-check-label">
                                                            <input type="checkbox" name="check[]" value="{{$list->id}}" id=""> {{$list->category_name}}
                                                        </label>
                                                    </div>
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