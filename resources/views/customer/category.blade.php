@extends('customer/layout')

@section('title','Category Page')

@section('content')

<section id="aa-product-category">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-8 col-md-push-3">
                <div class="aa-product-catg-content">
                    <div class="aa-product-catg-head">
                        <div class="aa-product-catg-head-left">
                        <div><span class="alert alert-success" id="cart-msg" style="display:none;"></span></div>
                        </div>
                        <div class="aa-product-catg-head-right">
                            <a id="grid-catg" href="#"><span class="fa fa-th"></span></a>
                            <a id="list-catg" href="#"><span class="fa fa-list"></span></a>
                        </div>
                    </div>
                    @if(isset($fetchProduct[0]))
                    <div class="aa-product-catg-body">
                        <ul class="aa-product-catg">
                          @foreach($fetchProduct as $product)
                           
                            <!-- start single product item -->
                            <li>
                                <figure>
                                    <a class="aa-product-img" href="{{route('productDetails',['slug'=>$product->product_slug])}}"><img src="{{asset('storage/admin_assets/product_images/'.$product->product_image)}}" alt="polo shirt img"></a>
                                    <a class="aa-add-card-btn btn" onclick="add_cart('{{$product->id}}')"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                                    <figcaption>
                                        <h4 class="aa-product-title"><a href="{{route('productDetails',['slug'=>$product->product_slug])}}">{{$product->product_name}}</a></h4>
                                        <span class="aa-product-price"><i class="fa fa-rupee"></i>{{$product->price}}</span>
                                        <span class="aa-product-price"><del><i class="fa fa-rupee"></i>{{$product->mrp}}</del></span>
                                        <p class="aa-product-descrip">{{$product->short_desc}}</p>
                                    </figcaption>
                                </figure>

                                <!-- product badge -->

                            </li>
                          @endforeach  

                        </ul>
                        <div class="aa-product-catg-pagination">
                           {{$fetchProduct->links()}}
                        </div>
                    </div>
                       @else
                            <div class="container w-50" style="margin-top:200px;">
                                <h3>NO Product Available At This Price</h3>
                            </div>
                          @endif 
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-4 col-md-pull-9">
                <aside class="aa-sidebar">
                    <!-- single sidebar -->
                    <div class="aa-sidebar-widget">
                        <h3>Category</h3>
                        <ul class="aa-catg-nav">
                            @foreach($category as $categoryName)
                            <li><a href="{{route('showCategoryProduct',['categorySlug'=>$categoryName->category_slug])}}">{{$categoryName->category_name}}</a></li>
                                 
                            @endforeach
                        </ul>
                    </div>
                    <!-- single sidebar -->
                    <!-- single sidebar -->
                    <div class="aa-sidebar-widget mb-5">
                        <h3>Shop By Price</h3>
                        <!-- price range -->
                        <div class="aa-sidebar-price-range">
                            <form action="{{route('priceRange',['id'=>$category_id])}}" method="get">
                                <span id="skip-value-lower" class="example-val">Min Value</span><input type="text" name="min" class="form-control" required>
                                <span id="skip-value-upper" class="example-val">Max Value</span><input type="text" name="max" class="form-control" required>
                                <button class="aa-filter-btn mt-3" type="submit" id="price">Filter</button>
                            </form>
                        </div>

                    </div>
                </aside>
            </div>

        </div>
    </div>
</section>


<form id="addToCartForm">
    @csrf
  <input type="hidden" name="product_id" id="product_id">
  <input type="hidden" name="pqty" id="pqty" value="1" >
  </form>

  <script>
     function add_cart(id){

       $("#product_id").val(id);
       $.ajax({

         url:"{{route('addToCart')}}",
         type:'POST',
         data:$("#addToCartForm").serialize(),
         success: function(result){
            if(result.status == false){
             $("#login-modal").modal("show");
           }
           else{
           $("#cart-msg").fadeIn('slow').text(result.cartmsg).fadeOut(3000);
           $("#cart_value").html(result.countCartProduct);
        }
         }
       });
     }
  </script>


@endsection